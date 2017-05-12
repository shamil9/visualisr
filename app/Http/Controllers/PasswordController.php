<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (! Hash::check($request->current_password, $request->user()->password)) {
            return back()
                ->withErrors(['current_password' => 'Incorrect password']);
        }

        if ($request->password !== $request->password_confirmation) {
            return back()
                ->withErrors(['password_confirmation' => 'Passwords do not match']);
        }

        $this->validate($request, [
            'password' => 'required|min:6'
        ]);

        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();

        return back()->with('flash', 'Password successfully updated');
    }
}
