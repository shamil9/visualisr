<?php

namespace App\Http\Controllers;

use App\SupportTicket;
use App\Visual;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['contact', 'storeTicket']]);
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
     * Show contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Save contact message
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
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

    public function showFavorites()
    {
        $favorites = auth()->user()->favorites->map(function ($favorite) {
            return $favorite->visual_id;
        });

        return view('home', ['visuals' => Visual::find($favorites->all())]);
    }
}
