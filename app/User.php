<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

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
        'password',
        'twitter_id',
        'twitter_profile_link_color',
        'twitter_profile_image_url',
        'twitter_profile_background_color',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function visuals() {
        return $this->hasMany(Visual::class);
    }

    public function canManage(User $user) {
        if ($user->id === \auth()->user()->id)
            return true;

        return false;
    }
}
