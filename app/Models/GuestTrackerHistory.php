<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\Models\Locations;

class GuestTrackerHistory extends Model
{
    protected $table = 'guest_tracker_history';

    public $timestamps = false;

    protected $fillable = [
        'location_id',
        'guest_name',
        'guest_city',	
        'guest_type',	
        'guest_used_new',
        'arrival_time',
        'created_at',
        'updated_at'
    ];
    
    public function location(){
        return $this->hasOne(Locations::class,'fldLocation','location_id');
    }
    
    public function type(){
        return $this->hasOne(GuestTypes::class,'id','guest_type');
    }
}
