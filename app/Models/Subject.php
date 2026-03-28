<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'board_id',
        'board_class_id',
        'active'
    ];

    public function board(){

        return $this->belongsTo(Board::class);

    }

    public function boardClass(){

        return $this->belongsTo(BoardClass::class);

    }

    public function chapters(){

        return $this->hasMany(chapter::class);

    }
    public function current_chapter(){

        return $this->hasOne(chapter::class);

    }
}
