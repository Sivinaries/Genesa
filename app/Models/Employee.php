<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'compani_id',
        'branch_id',
        'email',
        'nik',
        'phone',
        'address',
        'position',
        'join_date',
        'base_salary',
        'status',
        'role',
        'password',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
