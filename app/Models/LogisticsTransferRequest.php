<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class LogisticsTransferRequest extends Model
{
    protected $table = 'transfer_requests';

    protected $fillable = ['stock_no','user_id','crnt_date','crnt_time','current_location','transfer_date','transfer_time','transfer_location','transfer_method','transfered','email','driver'];

    public $timestamps =false;

    public function vehicle(){
        return $this->belongsTo(Vehicles::class,'stock_no','fldStockNo');
    }

    public function user(){
        return $this->belongsTo(Userdetails::class,'user_id','id');
    }

    public function driverUser(){
        return $this->belongsTo(Userdetails::class,'driver','id');
    }

    public function getCurrentTimeAttribute(){
        return $this->getAttributeValue('crnt_time');
    }

    public function getCurrentDateAttribute(){
        return $this->getAttributeValue('crnt_date');
    }

}
