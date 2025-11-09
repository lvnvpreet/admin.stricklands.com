<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\Models\Locations;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = ['product','code','phone','city','address','store_id','prov','postal'];

    public $timestamps = false;

    public function store(){
    	return $this->hasOne(Locations::class,'fldLocation','store_id');
    }
}
