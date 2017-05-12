<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display profile edit form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.profile');
    }

    public function update(Request $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $this->updateAvatar($request);
        }

        return back();
    }

    public function updateAvatar($request)
    {
        $user = $request->user();
        $oldAvatar = $user->avatar;
        $file = uniqid($user->name) . '.' . $request->avatar->extension();
        $avatar = Image::make($request->avatar)
                    ->resize(256, 256, function ($constraint) {
                            $constraint->upsize();
                        })
                    ->save(storage_path('app/public/avatars/'.$file));

        $user->avatar = $avatar->basename;
        $user->save();

        if ($oldAvatar != 'user.svg')
            unlink(storage_path('app/public/avatars/'.$oldAvatar));
    }
}
