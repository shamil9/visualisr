<?php

namespace App;

use App\Favorite;
use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    protected $fillable = [
        'track', 'artist', 'album', 'private'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
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

    /**
     * Get the number of comments for the visual.
     *
     * @return integer
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
}
