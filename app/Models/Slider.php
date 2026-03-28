<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'cms_id',
        'title',
        'sub_title',
        'description',
        'image',
        'image_2',
        'video_link',
        'file_type',
        'active'
    ];
}
