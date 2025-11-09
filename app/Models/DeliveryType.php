<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{
    protected $table = 'delivery_types';

    public $timestamps = false;

    public function location()
    {
        return $this->belongsTo(Locations::class,'fld_location','id');
    }
}
