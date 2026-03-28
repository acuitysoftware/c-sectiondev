<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'board_class_id',
        'subject_id',
        'weekly_question_set_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'active',
        'time'
    ];
}
