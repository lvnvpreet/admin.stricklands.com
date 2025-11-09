<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\Models\GuestTrackerHistory;

class GuestTypes extends Model
{
    protected $table = 'guest_tracker_types';

    public $timestamps = false;

    protected $fillable = ['id','name'];
    
    public function guest_history(){
        return $this->hasMany(GuestTrackerHistory::class,'guest_type','id');
    }
}
