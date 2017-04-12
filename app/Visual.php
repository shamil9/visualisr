<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    protected $fillable = [
        'track', 'artist', 'album'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
