<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitterAccount extends Model
{
    protected $fillable = [
        'user_id',
        'account_id',
        'name',
        'avatar',
        'profile_background_color',
        'profile_link_color',
        'profile_image_url',
    ];
}
