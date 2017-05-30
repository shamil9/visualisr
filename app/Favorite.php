<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id', 'visual_id',
    ];

    public function visual()
    {
        return $this->belongsTo(Visual::class);
    }
}
