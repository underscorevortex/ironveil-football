<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'team_id',
        'student_id',
        'phone',
        'date_of_birth',
        'address',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Department::class, 'team_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}