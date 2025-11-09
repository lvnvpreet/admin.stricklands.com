<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vanguard\Http\Requests\SupportTicketRequest;
use Vanguard\Mail\SupoortTicketCreated;
use Vanguard\Models\SupportCategory;
use Vanguard\Models\SupportTicket;
use Vanguard\Models\SupportTicketComments;
use Vanguard\Notifications\SupportTicketAssigned;
use Vanguard\Notifications\SupportTicketClosed;
use Vanguard\Notifications\SupportTicketReopen;
use Vanguard\Notifications\SupportTicketComment as CommentNotification;
use Vanguard\User;

class SupportTicketController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(auth()->user()->hasRole('superadmin')){
            $tickets = SupportTicket::with('comments')->where('is_closed',0)->orderBy('created_at','desc')->latest()->get();
        }else{
            $tickets = SupportTicket::with('comments')->where('assigned_to',auth()->user()->id)->where('is_closed',0)->orderBy('created_at','desc')->latest()->get();
        }
        $admins = User::all()->pluck('full_name','id')->toArray();
        return view('support-ticket.index',compact('tickets','admins'));
    }

    public function updateStatus(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'status'=>'required'
        ]);

        $ticket = SupportTicket::find($request->id);
        $this->authorize('access-ticket',$ticket);
        if(is_null($ticket)) return response()->json(['msg'=>'Can not find suppoert ticket #'.$request->id],403);

        $ticket->is_closed = $request->status;
        $ticket->save();
        if($request->status == 1){
            $ticket->user->notify(new SupportTicketClosed($ticket,auth()->user()));
        }
        return response()->json(['msg'=>'Successfully updated status of suppoert ticket #'.$request->id]);

    }

    public function create(SupportTicket $ticket)
    {

        $admins = User::where('id','<>',auth()->id())->get()->pluck('full_name','id')->toArray();
        $categories = SupportCategory::all()->pluck('name','id')->toArray();
        $categories = [0=>'Select Category'] + $categories;
        return view('support-ticket.add-edit',compact('ticket','categories','admins'));
    }

    public function edit(SupportTicket $ticket){
        if($ticket->is_closed) return redirect()->back()->withErrors('You can\'t edit a closed support ticket');

        $user = auth()->user();
        $categories = SupportCategory::all()->pluck('name','id')->toArray();
        $categories = [0=>'Select Category'] + $categories;
        $assigned = $ticket->users()->get();

        if($user->hasRole('superadmin') || $user->hasRole('Admin')){
            $admins = User::all()->pluck('full_name','id')->toArray();
            return view('support-ticket.admin.edit',compact('ticket','categories','admins','assigned'));
        }else{
            return view('support-ticket.add-edit',compact('ticket','categories'));
        }

    }

    public function save(SupportTicketRequest $request){
        $this->validate($request,[
            'category_id'=>'required',
            'priority'=>'required:in:LOW,MEDIUM,HIGH',
            //'assign_to'=>'required'
        ]);



        $admin = User::where('email','flennon@stricklands.com')->first();
        $user = auth()->user();
        $inputs = $request->only(['subject','category_id','priority','message']);

        if(!$request->filled('assign_to')){
            $request->merge(['assign_to'=>$admin->id]);
        }

        if($request->has('id') && $request->id){
            //Update Code
            $ticket = SupportTicket::find($request->id);
            $ticket->update($request->only(['subject','category_id','priority','message']));
            return redirect()->route('support-ticket.open')->withSuccess('Your support ticket #' . $ticket->id .' was successfully updated.');
        }else{

            //Create Code
            $ticket = new SupportTicket($inputs);
            $ticket->user_id = $user->id;
            $ticket->assigned_by = $user->id;
            $ticket->is_closed = 0;
            $ticket->save();
            if($request->hasFile('file')){
                $path = '';
                foreach($request->file as $fileData){
                    $file   =   $fileData;

                    $path   .=   \Storage::disk('public')->putFileAs('support-system/'.$ticket->id,$file,$file->getClientOriginalName());
                    if($fileData == end($request->file)) { $path .= ''; } else { $path .= ',';}
                    
                }
                $ticket->file = $path;
                $ticket->save();
            }

            $ticket->users()->attach($request->get('assign_to'));

            foreach($ticket->users()->get() as $user){
                //send notification
                $user->notify(new SupportTicketAssigned($ticket));
            }

            //Notification Section
            \Mail::to($admin)->send(new SupoortTicketCreated($ticket));

            return redirect()->route('support-ticket.open')->withSuccess('Your support ticket was successfully created. Ticket No. is #' . $ticket->id);
        }
    }

    public function downloadTicketFile(Request $request,$ticket){
        $file = $request->query('file');
        $ticket = SupportTicket::find($ticket);
        if($ticket->file){
            try{
                return response()->download(\Storage::disk('public')->path($file));
            }catch (Exception $exception){
                return $exception->getMessage();
            }
        }
    }

    public function update(SupportTicket $ticket, Request $request){
        $this->validate($request,[
            'category_id'=>'required',
            'priority'=>'required:in:LOW,MEDIUM,HIGH',
            'assign_to'=>'required',
            'is_closed'=>'required:in:0,1',
        ]);
        
        $path = '';
        if($request->hasFile('file')){
            foreach($request->file as $fileData){
                $file   =   $fileData;

                $path   .=   \Storage::disk('public')->putFileAs('support-system/'.$ticket->id,$file,$file->getClientOriginalName());
                if($fileData == end($request->file)) { $path .= ''; } else { $path .= ',';}
                
            }
        }
        
        if($ticket->file == '' ){
            $updatedFile = $path;
        }
        else
        {
            $updatedFile = ($request->file() == null) ? $ticket->file : $ticket->file.','.$path;
        }
        
        $ticket->update($request->only('category_id','priority','assigned_to','is_closed'));
        $ticket->update(['file'=> $updatedFile]);

        $ticket->users()->sync($request->get('assign_to'));

        foreach($ticket->users()->get() as $user){
            //send notification
            $user->notify(new SupportTicketAssigned($ticket));
        }

        if(array_key_exists('is_closed',$request->all())){
            if($ticket->is_closed){
                $ticket->user->notify(new SupportTicketClosed($ticket,auth()->user()));
            }else{
                $ticket->user->notify(new SupportTicketReopen($ticket,auth()->user()));
            }
        }

        return redirect()->back()->withSuccess('Support Ticket was successfully updated.');
    }

    public function openTickets(){
        $user = auth()->user();
        $tickets = $user->support_tickets()->where('is_closed',0)->latest()->get();
        return view('support-ticket.open-tickets',compact('tickets'));
    }

    public function openCloseTicket($id,$status){
        $ticket = SupportTicket::find($id);
        $this->authorize('access-ticket',$ticket);
        if(is_null($ticket)) return response()->json(['msg'=>'Can not find suppoert ticket #'.$id],403);

        $ticket->is_closed = $status;
        $ticket->save();
        if($status == 1){
            $ticket->user->notify(new SupportTicketClosed($ticket,auth()->user()));
        }
        return redirect()->back()->withSuccess('Support Ticket was successfully updated.');

    }

    public function closedTickets()
    {
        $user = auth()->user();
        $admins = User::all()->pluck('full_name','id')->toArray();
        if($user->hasRole('Admin'))
        {
            $tickets = SupportTicket::where('assigned_to',$user->id)->where('is_closed',1)->latest()->get();
            return view('support-ticket.index',compact('tickets','admins'));
        }
        elseif ( $user->hasRole('superadmin') )
        {
            $tickets = SupportTicket::where('is_closed',1)->latest()->get();
            return view('support-ticket.index',compact('tickets','admins'));
        }
        abort(403);
    }

    public function view(SupportTicket $ticket){
        $ticket->load('user','assignedTo','assignedBy');
        return view('support-ticket.view',compact('ticket'));
    }

    public function comment(SupportTicket $ticket,Request $request)
    {
        $this->validate($request,[
            'comment'=>'required'
        ]);

        $comment = new SupportTicketComments();
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;

        if($request->hasFile('file')){
            $path = '';
            foreach($request->file as $fileData){
                $file   =   $fileData;

                $path   .=   \Storage::disk('public')->putFileAs('support-system/comment/'.$ticket->id,$file,$file->getClientOriginalName());
                if($fileData == end($request->file)) { $path .= ''; } else { $path .= ',';}
                
            }
            $comment->file = $path;
        }
        $ticket->comments()->save($comment);

        $user = auth()->user();
        $ticket->load('user','assignedTo');

        if($user->id == $ticket->user_id)
        {
            if($ticket->assignedTo){
                $ticket->assignedTo->notify(new CommentNotification($ticket,$user,$comment));
            }
        }
        elseif($user->id == $ticket->assigned_to)
        {
            $ticket->user->notify(new CommentNotification($ticket,$user,$comment));
        }
        else{
            if($ticket->assignedTo){
                $ticket->assignedTo->notify(new CommentNotification($ticket,$user,$comment));
            }
            $ticket->user->notify(new CommentNotification($ticket,$user,$comment));
        }

        return redirect()->back()->withSuccess('Comment was successfully posted on this ticket');
    }

    public function showCatgories(){
        $categories = SupportCategory::all();
        return view('support-ticket.admin.categories',compact('categories'));
    }

    public function saveCategory(Request $request){
        $this->validate($request,[
            'name'=> 'required'
            ]);
        $user = auth()->user();
        if($request->has('id') && (int) $request->id){
            SupportCategory::updateOrCreate(['id'=>$request->id],['name'=>$request->name,'created_by'=>$user->id]);
        }else{
            SupportCategory::create(['name'=>$request->name,'created_by'=>$user->id]);
        }
        return redirect()->back()->withSuccess("Support Category successfully Saved.");
    }

    public function deleteCategory(Request $request){

        SupportCategory::destroy($request->id);

        return redirect()->back()->withSuccess("Support Category successfully deleted.");
    }

    public function deleteTicketImage(Request $request){
        if($request->ajax())
        {
            $ticket = SupportTicket::find($request->ticketId);
            $fileArray = explode(',',$ticket->file);

            $key = array_search($request->file, $fileArray);
            unset($fileArray[$key]);

            \Storage::disk('public')->delete($request->file);
            $ticket->file= implode(',',$fileArray);
            $ticket->save();
            return response()->json(['message'=>true]);
        }
        return response()->json(['message'=>false]);
    }

    public function deleteCommentImage(Request $request){
        if($request->ajax())
        {
            $comment = SupportTicketComments::find($request->commentId);
            $fileArray = explode(',',$comment->file);

            $key = array_search($request->file, $fileArray);
            unset($fileArray[$key]);
            \Storage::disk('public')->delete($request->file);
            $comment->file= implode(',',$fileArray);
            $comment->save();
            return response()->json(['message'=>true]);
        }
        return response()->json(['message'=>false]);
    }

    public function updateComment(Request $request){
        $comment = SupportTicketComments::find($request->commentId);

        if($request->file()){
            $path = '';

            foreach($request->file() as $file){

                $path   .=   \Storage::disk('public')->putFileAs('support-system/comment/'.$request->commentId,$file,$file->getClientOriginalName());
                if($file == end($request->file())) { $path .= ''; } else { $path .= ',';}
                
            }
        }

        if($comment->file == ''){
            $updatedFile = $path;
        }
        else{
            $updatedFile = ($request->file() == null) ? $comment->file : $comment->file.','.$path;
        }
        $comment->update(['comment' => $request->comment,'file'=>$updatedFile]);
        $data =$comment->get();

        return response()->json($data);
    }

    public function updateAssignee(Request $request){

        $ticket = SupportTicket::findOrFail($request->get('id'));
        $assigned = $ticket->users->pluck('id')->toArray();

        if($request->has('assignee') && count($request->get('assignee'))>0){

            $ticket->users()->sync($request->get('assignee'));
            foreach($ticket->users()->get() as $user){
                if(!in_array($user->id,$assigned)){
                    //send notification
                    $user->notify(new SupportTicketAssigned($ticket));
                }
            }
        }

    }
}
