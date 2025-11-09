<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class LogisticsNotes extends Model
{
    protected $table = 'logistics_notes';

    protected $fillable = ['stock_no','note','date','time','user_id'];

    public $timestamps = false;



    public function user(){
        return $this->belongsTo(Userdetails::class,'user_id','id');
    }

}
