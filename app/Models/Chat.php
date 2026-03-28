<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
     protected $guarded = [];

     public function subject(){

        return $this->belongsTo(Subject::class);

    }
     public function user(){

        return $this->belongsTo(User::class);

    }
     public function last_chat(){

        return $this->hasOne(SuperChat::class)->latest();

    }
     public function first_chat(){

        return $this->hasOne(SuperChat::class)->oldest();

    }
     public function messages(){

        return $this->hasMany(SuperChat::class)->oldest();

    }
}
