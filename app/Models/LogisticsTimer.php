<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class LogisticsTimer extends Model
{
    protected $table = 'logistics_timers';

    public $timestamps = false;

    protected $fillable = ['stock_no','checkin_date','checkin_time','location','type','checkout_date','checkout_time'];

    public function vehicle(){
        return $this->belongsTo(Vehicles::class,'stock_no','fldStockNo');
    }

    public function indicators(){
        return $this->hasOne(LogisticsIndicators::class,'stock_no','stock_no');
    }
}
