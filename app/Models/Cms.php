<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cmsGalleries()
    {
        return $this->hasMany(CmsGallery::class);
    }

    public function cmsDetails()
    {
        return $this->hasMany(CmsDetails::class);
    }
}
