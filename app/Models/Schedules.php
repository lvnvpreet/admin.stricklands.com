<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $table = 'schedules';

    protected $fillable =   ['date','start_time','end_time','reserved_for','details','location'];

}
