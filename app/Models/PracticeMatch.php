<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeMatch extends Model
{
    protected $fillable = [
        'coach_id',
        'team_id',
        'opponent',
        'match_date',
        'match_time',
        'venue',
        'status',
        'result',
    ];

    protected $casts = [
        'match_date' => 'date',
    ];

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function team()
    {
        return $this->belongsTo(Department::class, 'team_id');
    }
}