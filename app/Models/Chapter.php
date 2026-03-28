<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'board_id',
        'board_class_id',
        'subject_id',
        'description',
        'active'
    ];

    public function board(){

        return $this->belongsTo(Board::class);

    }

    public function boardClass(){

        return $this->belongsTo(BoardClass::class);

    }

    public function subject(){

        return $this->belongsTo(Subject::class);

    }

    public function chapterFiles(){

        return $this->hasMany(ChapterFile::class);

    }

    public function questionSet(){

        return $this->hasOne(QuestionSet::class);

    }
}
