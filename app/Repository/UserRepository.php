<?php

namespace App\Repository;


use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function find(array $columns = [])
    {
        $user = DB::table('users')
            ->select(
                'users.*',
                DB::raw('count(favorites.id) as favorites_count')
            )
            ->leftJoin('favorites', 'users.id', '=', 'favorites.user_id')
            ->leftJoin('visuals', 'users.id', '=', 'visuals.user_id')
            ->groupBy('users.id');

        if (isset($columns['id'])) $user->where('users.id', '=', $columns['id']);
        if (isset($columns['slug'])) $user->where('users.slug', '=', $columns['slug']);

        return $user;
    }
}