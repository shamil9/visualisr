<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Visual;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function stats()
    {
        if (!auth()->user()->admin) return;

        $users = User::all()->count();
        $visuals = Visual::all()->count();
        $comments = Comment::all()->count();
        $views = Redis::zrange('visual', 0, -1, 'WITHSCORES');
        $totalViews = collect($views)->sum();

        return view('admin.stats', compact('users', 'visuals', 'comments', 'totalViews'));
    }

    public function statsCount()
    {
        if (!auth()->user()->admin) return;

        $comments = $this->getStats('comments');
        $visuals = $this->getStats('visuals');
        $users = $this->getStats('users');

        return compact('comments', 'visuals', 'users');
    }

    public function getStats($table)
    {
        $count = DB::table($table)
                     ->select(DB::raw('count(*) as count'))
                     ->groupBy('created_at')
                     ->get()
                     ->map(function ($object) {
                        return $object->count;
                    });

        return $count;
    }
}
