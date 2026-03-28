<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyQuestionSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id',
        'total_time',
        'time_per_question',
        'pass_marks',
        'date',
        'time',
        'active'
    ];

    public function questions()
    {
    	return $this->hasMany(WeeklyQuestion::class);
    }
}
