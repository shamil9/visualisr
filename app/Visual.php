<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Visual extends Model
{
    protected $fillable = [
        'track',
        'artist',
        'album',
        'private',
        'user_id',
    ];

    protected $with = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
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
        // return !! auth()->user()->favorites->contains(['visual_id' => $this->id]);
        return ! ! $this->favorites()->where([
            'user_id'   => auth()->id(),
            'visual_id' => $this->id,
        ])->first();
    }

    /**
     * Get the number of views for the visual.
     *
     * @return integer
     */
    public function getViewsAttribute()
    {
        return Redis::zscore('visuals-views', $this->id);
    }

    /**
     * Get the rating for the visual.
     *
     * @return integer
     */
    public function getRatingAttribute()
    {
        return substr(Redis::zscore('visuals-rating', $this->id), 0, 3);
    }

    /**
     * Check if visual is private
     *
     * @return bool
     */
    public function isPrivate()
    {
        return $this->private && $this->user_id !== auth()->id()
        || $this->private && ! auth()->check() ? true : false;
    }
}
