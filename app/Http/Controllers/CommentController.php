<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Visual;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check'], ['except' => ['index', 'show', 'pagination']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   \Illuminate\Http\Request $request
     * @param   Visual                   $visual
     * @return  \Illuminate\Http\Response
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

        return redirect(route('visuals.show', $visual))
            ->with('flash', 'Comment added successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Visual                    $visual
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
     * @param Visual        $visual
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visual $visual, Comment $comment)
    {
        $this->authorize('destroy', Comment::class);
        $comment->delete();

        return back()->with('flash', 'Comment successfully deleted');
    }

    /**
     * Validate comment form
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    private function validateComment($request)
    {
        return $this->validate($request, [
            'user_id'   => 'exists:users',
            'visual_id' => 'exists:visuals',
            'body'      => 'required|max:180|min:2',
        ]);
    }

    public function pagination($id)
    {
        return Comment::where('visual_id', $id)
            ->with('user')
            ->orderBy('id', 'desc')
            ->simplePaginate(5, ['*'], 'page', 2);
    }
}
