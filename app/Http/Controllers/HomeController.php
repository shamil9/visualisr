<?php

namespace App\Http\Controllers;

use App\SupportTicket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = auth()->user();

        return view('home', compact('user'));
    }

    /**
     * Show contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact');
    }

    public function storeTicket(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:10',
            'email' => 'required',
            'name' => 'required',
        ]);

        $message = new SupportTicket();
        $message->create($request->only(['body', 'name', 'email']));

        return back()->with('flash', 'Message sent with success');
    }
}
