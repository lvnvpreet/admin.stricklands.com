<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class SupportCategory extends Model
{
    protected $table = 'support_categories';

    protected $fillable = ['name','created_by'];

    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function tickets()
    {
        return $this->belongsTo(SupportCategory::class,'category_id','id');
    }
}
