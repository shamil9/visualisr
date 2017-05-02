<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RatingController extends Controller
{
    /**
     * RatingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rating' => 'required',
            'visual' => 'required|exists:visuals,id',
        ]);

        return $this->getAverageRating($request->visual, $request->rating);
    }

    /**
     * Compute and store average rating for the visual
     *
     * @param  int $visual
     * @param  int $rating
     * @return int
     */
    public function getAverageRating($visual, $rating)
    {
        Redis::hset('visual.' . $visual, 'user.' . auth()->id(), $rating);
        $ratings = collect(Redis::hvals('visual.' . $visual))->avg();

        return Redis::zadd('visuals', $ratings, 'visual.' . $visual);
    }
}
