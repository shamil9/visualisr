<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Visual;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return integer
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'visual_id' => 'required',
        ]);

        $favorite = Favorite::where(['user_id' => $request->user_id,
                            'visual_id' => $request->visual_id]);
        $inFavorites = $favorite->exists();

        if ($inFavorites) {
            $favorite->delete();

            return Visual::find($request->visual_id)->favorites->count();
        }

        Favorite::create([
            'user_id' => $request->user_id,
            'visual_id' => $request->visual_id,
        ]);

        return Visual::find($request->visual_id)->favorites->count();
    }
}
