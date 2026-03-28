<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardPoint extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function joinUser(){

        return $this->belongsTo(User::class, 'join_user_id', 'id');

    }
}
