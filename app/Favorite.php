<?php

namespace App;

use App\User;
use App\Visual;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id', 'visual_id'
    ];
}
