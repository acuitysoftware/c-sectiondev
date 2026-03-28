<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'file_original_name',
        'file_name',
        'file_type',
        'active'
    ];
}
