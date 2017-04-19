<?php

namespace App\Http\Controllers;

use App\Events\VisualDestroyEvent;
use App\Events\VisualStoreEvent;
use App\Events\VisualUpdateEvent;
use App\Listeners\VisualUpdateEventListener;
use App\Visual;
use Illuminate\Http\Request;

class VisualController extends Controller
{
    /**
     * VisualController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visuals = Visual::where(['private' => 0])->orderBy('id', 'desc')->paginate(10);
        return view('visuals.index', compact('visuals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visuals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkFields($request);

        $visual = new Visual();
        event(new VisualStoreEvent($visual, $request));

        return $visual;
    }

    /**
     * Display the specified resource.
     *
     * @param Visual $visual
     * @return \Illuminate\Http\Response
     * @internal param Image $image
     */
    public function show(Visual $visual)
    {
        return view('visuals/show', compact('visual'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Visual $visual
     * @return \Illuminate\Http\Response
     * @internal param Image $image
     */
    public function edit(Visual $visual)
    {
        $this->userCheck($visual->user);

        return view('visuals.edit', compact('visual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Visual                    $visual
     * @return \Illuminate\Http\Response
     * @internal param Image $image
     */
    public function update(Request $request, Visual $visual)
    {
        $this->userCheck($visual->user);
        $this->checkFields($request);

        event(new VisualUpdateEvent($visual, $request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visual $visual
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visual $visual, Request $request)
    {
        $this->userCheck($visual->user);
        event(new VisualDestroyEvent($visual, $request));

        return redirect()->route('user.home');
    }

    public function checkFields($request)
    {
        return $this->validate($request, [
            'track' => 'required',
            'album' => 'required',
            'artist' => 'required',
        ]);
    }
}
