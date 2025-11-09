<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\Models\GuestTrackerHistory;

class Locations extends Model
{
    protected $table = 'locations';

    public $timestamps = false;

    protected $fillable = ['id','fldLocation','fldLocationName','fldShortName','fldCode','fldStoreTarget','fldStoreNewTarget','fldPhone',
        'fldAddress','fldPostal','fldWebSite','day_start','day_end','day_num','days_total','fldLocationOrder'];
        
    public function guest_history(){
        return $this->hasMany(GuestTrackerHistory::class,'location_id', 'fldLocation');
    }
}
