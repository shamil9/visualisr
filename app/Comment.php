<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'visual_id', 'body'];
    protected $with = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visual()
    {
        return $this->belongsTo(Visual::class);
    }
}
