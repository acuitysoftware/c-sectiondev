<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function subject(){

        return $this->belongsTo(Subject::class);

    }

    public function chapter(){

        return $this->belongsTo(Chapter::class);

    }

    public function questions(){

        return $this->hasMany(ExamQuestion::class);

    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }
    public function class()
    {
        return $this->belongsTo(BoardClass::class, 'board_class_id');
    }
}
