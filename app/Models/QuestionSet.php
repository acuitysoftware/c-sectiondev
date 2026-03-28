<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'board_class_id',
        'subject_id',
        'chapter_id',
        'total_time',
        'time_per_question',
        'pass_marks',
        'exam_type',
        'test_type',
        'reward_point',
        'class_group_id',
        'start_date',
        'time',
        'pass_marks_percentage',
        'active'
    ];

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
