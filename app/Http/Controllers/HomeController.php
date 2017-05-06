<?php

namespace App\Http\Controllers;

use App\Visual;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check']);
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = auth()->user();
        return view('home', ['visuals' => $user->visuals, 'user' => $user]);
    }

    /**
     * Show list of user favorites visuals
     *
     * @return \Illuminate\Http\Response
     */
    public function showFavorites()
    {
        $favorites = auth()->user()->favorites->map(function ($favorite) {
            return $favorite->visual_id;
        });

        return view('home', ['visuals' => Visual::find($favorites->all())]);
    }
}
