<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class NewsUpdates extends Model
{
    protected $table = 'news_updates';

    protected $fillable = [
        'title','content','image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
