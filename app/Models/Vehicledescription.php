<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicledescription extends Model
{
    protected $table = 'descriptions';

    public $timestamps = false;


    public function vehicle(){
        return $this->belongsTo(Vehicles::class,'fldStockNo','fldStockNo')->orderBy('id','DESC');
    }
}
