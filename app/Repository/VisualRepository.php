<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class VisualRepository
{
    /**
     * Find by id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function find(int $id)
    {
        return DB::table('visuals')
            ->select(
                'visuals.*',
                'users.name as name',
                'users.id as user_id',
                'users.avatar as avatar',
                'users.slug as slug',
                DB::raw('count(comments.id) as comments_count'),
                DB::raw('count(favorites.id) as favorites_count')
            )
            ->leftJoin('users', 'visuals.user_id', '=', 'users.id')
            ->leftJoin('comments', 'visuals.id', '=', 'comments.visual_id')
            ->leftJoin('favorites', 'visuals.id', '=', 'favorites.visual_id')
            ->where('visuals.id', '=', $id)
            ->groupBy('visuals.id');
    }

    /**
     * Get all visuals with relations
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return DB::table('visuals')
            ->select(
                'visuals.*',
                'users.name as name',
                'users.id as user_id',
                'users.avatar as avatar',
                'users.slug as slug',
                DB::raw('count(comments.id) as comments_count'),
                DB::raw('count(favorites.id) as favorites_count')
            )
            ->leftJoin('users', 'visuals.user_id', '=', 'users.id')
            ->leftJoin('comments', 'visuals.id', '=', 'comments.visual_id')
            ->leftJoin('favorites', 'favorites.visual_id', '=', 'visuals.id')
            ->groupBy('visuals.id');


        // Raw query
        //        return DB::select('
        //          SELECT *, count(comments.id) AS comment_count, count(favorites.id) AS favorites_count
        //          FROM visuals
        //          left JOIN users ON users.id = visuals.user_id
        //          left JOIN comments ON comments.visual_id = visuals.id
        //          LEFT JOIN favorites ON favorites.visual_id = visuals.id
        //          WHERE visuals.private = 0
        //          GROUP BY visuals.id
        //        ');

        // Simplest way (without n+1) but less efficient
        //        $visuals = Visual::where(['private' => 0])
        //            ->with('comments', 'favorites', 'user')
        //            ->orderBy('id', 'desc')
        //            ->paginate(9);
    }
}
