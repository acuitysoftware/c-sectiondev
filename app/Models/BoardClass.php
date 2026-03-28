<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'board_id',
        'price',
        'active'
    ];

    public function board(){

        return $this->belongsTo(Board::class);

    }

    public function boardSubject(){

        return $this->hasMany(Subject::class);

    }
}
