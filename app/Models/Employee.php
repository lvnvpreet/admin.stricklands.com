<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'location',
        'wage',
        'position',
        'department',
        'start_date',
        'notes',
    ];

    public function getFullNameAttribute()
    {
        return $this->getAttributeValue('first_name') . " " . $this->getAttributeValue('last_name');
    }
}
