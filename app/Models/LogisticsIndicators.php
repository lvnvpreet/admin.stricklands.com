<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class LogisticsIndicators extends Model
{
    protected $table = 'logistics_indicators';

    public $timestamps = false;

    protected $fillable = ['stock_no','cleaned','pictured','safetied','etested'];

    public function vehicle(){
        return $this->belongsTo(Vehicles::class,'stock_no','fldStockNo');
    }

    public function timers(){
        return $this->hasMany(LogisticsTimer::class,'stock_no','stock_no')->orderBy('id','desc');
    }

}
