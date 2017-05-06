<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * BlogController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check'], ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->with('user')->paginate(3);

        return view('blog', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Blog::class);

        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Blog::class);
        $this->validateFields($request);

        $blog = new Blog();
        $blog->create([
            'body'    => $request->body,
            'title'   => $request->title,
            'user_id' => auth()->id(),
        ]);

        return redirect(route('blog.index'))
            ->with('flash', 'Article successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $this->authorize('update', Blog::class);

        return view('admin.blog.create', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Blog                $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', Blog::class);
        $this->validateFields($request);

        $blog->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return redirect(route('blog.index'))
            ->with('flash', 'Article successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('destroy', Blog::class);
        $blog->delete();

        return redirect(route('blog.index'))
            ->with('flash', 'Article successfully deleted');
    }

    public function validateFields($request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
        ]);
    }
}
