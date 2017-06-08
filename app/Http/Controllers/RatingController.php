<?php

namespace App\Http\Controllers;

use App\Visual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RatingController extends Controller
{
    /**
     * RatingController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check'], ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topVisuals = Redis::zrange('visuals-rating', 0, -1);
        $visuals = Visual::where(['private' => 0])
            ->with('user')
            ->withCount('comments', 'favorites')
            ->orderByRaw('FIELD(id,' .implode(',',$topVisuals). ') DESC')
            ->paginate(9);

        return view('visuals.index', compact('visuals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return int
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

        return Redis::zadd('visuals-rating', $ratings, $visual);
    }
}
