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

    public function compani()
    {
        return $this->belongsTo(Compani::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
