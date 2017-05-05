<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Comment;
use App\User;
use App\Visual;

class StatsController extends Controller
{
    /**
     * Display stats page
     *
     * @return Illuminate\Http\Response
     */
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

    /**
     * Return json object with stats
     *
     * @return string
     */
    public function statsCount()
    {
        if (!auth()->user()->admin) return;

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
