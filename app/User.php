<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'slug',
        'password',
        'twitter_id',
        'twitter_profile_link_color',
        'twitter_profile_image_url',
        'twitter_profile_background_color',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function visuals()
    {
        return $this->hasMany(Visual::class)
            ->withCount('favorites', 'comments');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function twitter()
    {
        return $this->hasOne(TwitterAccount::class);
    }
}
