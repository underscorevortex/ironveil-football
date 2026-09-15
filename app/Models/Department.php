<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'team_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'department_id');
    }

    public function practiceMatches()
    {
        return $this->hasMany(PracticeMatch::class, 'team_id');
    }
}