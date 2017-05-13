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

    /**
     * Update user profile
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid())
            $this->updateAvatar($request);

        if ($request->has('email'))
            $this->updateEmail($request);

        return back();
    }

    /**
     * Store and save new user avatar
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
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

    /**
     * Update user email address
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function updateEmail($request)
    {
        if ($request->email !== $request->email_confirmation)
            return back()
                ->withErrors(['email_confirmation' => 'Emails do not match']);

        $this->validate($request, [
            'email' => 'required'
        ]);

        $request->user()->fill([
            'email' => $request->email
        ])->save();
    }
}
