<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\VisualDestroyEvent;
use App\Events\VisualStoreEvent;
use App\Events\VisualUpdateEvent;
use App\Visual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class VisualController extends Controller
{
    /**
     * VisualController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check'], ['except' => ['index', 'show', 'create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visuals = Visual::where(['private' => 0])
            ->with('user')
            ->withCount('comments', 'favorites')
            ->orderBy('id', 'desc')
            ->paginate(9);

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
     * @return Visual
     */
    public function store(Request $request)
    {
        $this->checkFields($request);

        $visual = new Visual();
        event(new VisualStoreEvent($visual, $request));
        $request->session()->flash('flash', 'Visual created with success');

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
        if ($visual->private &&
            $visual->user_id !== auth()->id() ||
            $visual->private && ! auth()->check()
        ) {
            return view('visuals.private-error');
        }

        Redis::zincrby('visuals-views', 1, $visual->id);
        $visual->userRating = Redis::hget('visual.' . $visual->id, 'user.' . auth()->id());

        $comments = Comment::where('visual_id', $visual->id)
            ->with('user')
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        return view('visuals.show', compact('visual', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Visual $visual
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @internal param Image $image
     */
    public function edit(Visual $visual)
    {
        $this->authorize('update', $visual);

        return view('visuals.edit', compact('visual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Visual                    $visual
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Visual $visual)
    {
        $this->authorize('update', $visual);
        $this->checkFields($request);

        event(new VisualUpdateEvent($visual, $request));
        $request->session()->flash('flash', 'Visual updated with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visual $visual
     * @param Request      $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Visual $visual, Request $request)
    {
        $this->authorize('delete', $visual);
        event(new VisualDestroyEvent($visual, $request));

        return redirect(route('visuals.index'))
            ->with('flash', 'Viusal successfully deleted');
    }

    /**
     * Validate form fields
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function checkFields($request)
    {
        return $this->validate($request, [
            'track'  => 'required|min:2',
            'album'  => 'required|min:2',
            'artist' => 'required|min:2',
        ]);
    }
}
