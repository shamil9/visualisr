<?php

namespace App;

use App\Favorite;
use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    protected $fillable = [
        'track', 'artist', 'album', 'private'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if current visual is already have been favourited
     * @return boolean
     */
    public function inFavorites()
    {
        return !! $this->favorites->count();
    }

    /**
     * Get the number of favorites for the visual.
     *
     * @return integer
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
