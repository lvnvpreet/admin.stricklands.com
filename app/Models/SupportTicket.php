<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class SupportTicket extends Model
{
    protected $table = 'support_tickets';

    protected $fillable= [
        'user_id',
        'category_id',
        'priority',
        'subject',
        'file',
        'message',
        'assigned_to',
        'assigned_by',
        'is_closed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(SupportCategory::class,'category_id','id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class,'assigned_to','id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class,'assigned_by','id');
    }

    public function comments()
    {
        return $this->hasMany(SupportTicketComments::class,'ticket_id','id');
    }

    public function getFileNameAttribute(){
        if($this->file)
            return end(explode('/',$this->file));
        else
            return '';
    }

    public function IsDownloadableAttribute(){
        if($this->file)
            $file_extension =pathinfo(\Storage::disk('public')->path($this->file), PATHINFO_EXTENSION);
            $extension =array('jpg', 'png', 'gif','jpeg');
            return in_array(strtolower($file_extension), $extension);
    }

    public function getFileUrl(){
        if($this->file)
            return \Storage::disk('public')->url($this->file);
        else
            return '';
    }

    public function users(){
        return $this->belongsToMany(User::class,'support_user');
    }
}
