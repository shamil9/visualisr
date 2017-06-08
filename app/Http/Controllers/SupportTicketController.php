<?php

namespace App\Http\Controllers;

use App\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check'], ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = SupportTicket::all();

        return view('admin.contact.index', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateFields($request);
        $message = new SupportTicket();
        $message->create($request->only(['body', 'name', 'email']));

        return back()->with('flash', 'Message sent with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SupportTicket $contact
     * @return \Illuminate\Http\Response
     * @internal param SupportTicketCreated $supportTicket
     */
    public function destroy(SupportTicket $contact)
    {
        $this->authorize('manage', SupportTicket::class);
        $contact->delete();

        return back()->with('flash', 'Support Ticket successfully deleted');
    }

    public function validateFields(Request $request)
    {
        if (auth()->check()) {
            $request->request->add(['email' => auth()->user()->email]);
            $request->request->add(['name' => auth()->user()->name]);
        }

        $this->validate($request, [
            'body'  => 'required|min:10',
            'email' => 'required',
            'name'  => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }
}
