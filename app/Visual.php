<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Visual extends Model
{
    protected $fillable = [
        'track', 'artist', 'album', 'private'
    ];

    protected $with = ['favorites', 'comments', 'user'];

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
     * Check if current visual is already have been favorited
     *
     * @return boolean
     */
    public function inFavorites()
    {
        return !! $this->favorites->count();
    }

    /**
     * Get the number of views for the visual.
     *
     * @return integer
     */
    public function getViewsAttribute()
    {
        return Redis::incr('visual' . $this->id);
    }

    /**
     * Get the rating for the visual.
     *
     * @return integer
     */
    public function getRatingAttribute()
    {
        return Redis::zscore('visuals', 'visual.' . $this->id);
    }
}
