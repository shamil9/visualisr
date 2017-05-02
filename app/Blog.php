<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['user_id', 'body', 'title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
