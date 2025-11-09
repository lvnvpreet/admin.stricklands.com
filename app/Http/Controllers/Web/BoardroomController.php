<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Custom;
use Illuminate\Http\Request;
use Vanguard\Models\Locations;
use Vanguard\Models\Schedules;

use Auth;

/**
 * Class ActivityController
 * @package Vanguard\Http\Controllers
 */
class BoardroomController extends Controller
{
    /**
     * @var EloquentActivity
     */
    private $activities;

    /**
     * InventoryController constructor.
     * @param ActivityRepository $activities
     */
    public function __construct(Request $requests)
    {
        $this->middleware('auth');
        $this->middleware('permission:boardroom.manage-bookings')->except(['calenderSchedule','listDetail']);

        $locations = $requests->route('location');

        // allow only 2 locations for now
        if(!in_array($locations,['brantford','stratford'])) abort(404);
    }



	public function manageSchedule(Request $request, $location){

        if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('superadmin'))
		    $schedules = Schedules::where('location',$location)->get();
        else
            $schedules = auth()->user()->schedules()->where('location',$location)->get();

		return view('boardroom.list',compact('location','schedules'));
	}

	public function calenderSchedule(Request $request,$location){
        if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('superadmin'))
            $schedules = Schedules::where('location',$location)->get();
        else
            $schedules = auth()->user()->schedules()->where('location',$location)->get();
        
		return view('boardroom.calender',compact('location','schedules'));
	}

	public function listDetail(Request $request,$location, $date){
    	$schedules = auth()->user()->schedules()->where('location',$location)->where('date',$date)->get();
    	if(is_null($schedules)) abort(404);

    	return view('boardroom.event-datail',compact('location','schedules','date'));

	}



     public function addschedule($location){
        $edit = null;
        return view('boardroom.add',compact('location','edit'));
     }


     public function storeschedule(Request $request,$location){


         $request->validate([
             'schedule_date' => 'required',
             'start_time' => 'required',
             'reserved_for' => 'required',
             'end_time' => 'required',
         ]);

	     auth()->user()->schedules()->create([
		     'date'=>   $request->get('schedule_date'),
		     'start_time'=>  date('H:i:s',strtotime($request->get('start_time'))),
		     'end_time'=>    date('H:i:s',strtotime($request->get('end_time'))),
		     'reserved_for'=>$request->get('reserved_for'),
		     'details'=>   $request->get('details'),
		     'location' => $location
	     ]);

        return redirect()->route('boardroom.list',$location)->with('success','Schedule added successfully');

     }

     public function editSchedule(Request $request, $location, Schedules $schedule){

	     return view('boardroom.edit',compact('location','schedule'));
     }

     public function updateSchedule(Request $request, $location, Schedules $schedule){
	     $request->validate([
		     'schedule_date' => 'required',
		     'start_time' => 'required',
		     'reserved_for' => 'required',
		     'end_time' => 'required',
	     ]);

	     $schedule->update([
		     'date'=>   $request->get('schedule_date'),
		     'start_time'=>  date('H:i:s',strtotime($request->get('start_time'))),
		     'end_time'=>    date('H:i:s',strtotime($request->get('end_time'))),
		     'reserved_for'=>$request->get('reserved_for'),
		     'details'=>   $request->get('details'),
		     'location' => $location
	     ]);

	     return redirect()->route('boardroom.list',$location)->with('success','Schedule updated successfully');
     }

     public function deleteSchedule(Request $request, $location, Schedules $schedule){
	     $schedule->delete();
	     return redirect()->route('boardroom.list',$location)->with('success','Schedule deleted successfully');
     }

}
