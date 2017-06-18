<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Visual;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check']);
    }

    /**
     * Display stats page
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        $users = User::all()->count();
        $visuals = Visual::all()->count();
        $comments = Comment::all()->count();
        $views = Redis::zrange('visuals-views', 0, -1, 'WITHSCORES');
        $totalViews = collect($views)->sum();

        return view('admin.stats', compact('users', 'visuals', 'comments', 'totalViews'));
    }

    /**
     * Return json object with stats
     *
     * @return string
     */
    public function statsCount()
    {
        $comments = $this->getStats('comments');
        $visuals = $this->getStats('visuals');
        $users = $this->getStats('users');

        return compact('comments', 'visuals', 'users');
    }

    /**
     * Get stats sorted by month
     *
     * @param  string $table
     * @return array
     */
    private function getStats($table)
    {
        $count = DB::select("
                    select count(*) as count, monthname(created_at) as month
                    from {$table}
                    where created_at between now() - INTERVAL 6 MONTH and NOW()
                    group by month
                    order by created_at
                ");

        return $count;
    }
}
