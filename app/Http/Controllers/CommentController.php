<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Visual;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct () {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Visual                    $visual
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Visual $visual)
    {
        $this->authorize('create', Comment::class);
        $this->validateComment($request);

        $visual->comments()->create([
            'user_id'   => auth()->id(),
            'visual_id' => $visual->id,
            'body'      => $request->body,
        ]);

        return redirect(route('visuals.show', $visual));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Comment $comment)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment             $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visual $visual, Comment $comment)
    {
        $this->authorize('update', $comment);
        $this->validateComment($request);
        $comment->update(['body' => $request->body]);

        return $comment->body;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    /**
     * Validate comment form
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Respone
     */
    private function validateComment($request)
    {
        return $this->validate($request, [
            'user_id'   => 'exists:users',
            'visual_id' => 'exists:visuals',
            'body'      => 'required|max:180|min:2',
        ]);
    }
}
