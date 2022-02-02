<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        return view('dashboard.post', [
            'posts' => Post::all()->sortByDesc('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.post-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|int
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre_inferieur' => 'required',
            'titre_superieur' => 'required',
            'desc' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = str_replace(' ', '-', Str::lower($request->titre_superieur)) . '.' . $request->cover->extension();
        $imageName = $request->file('cover')->storeAs('post', $imageName, 'public') ;

        $post = Post::create([
            'sub_title' => $request->titre_inferieur,
            'sup_title' => $request->titre_superieur,
            'content' => $request->desc,
            'cover' => $imageName,
            'user_id' => Auth::user()->id,
        ]);
        return back()->with('status', $post->sup_title . " publié avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $title)
    {
        return view('article', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return Application|Factory|View|Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.post-edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titre_inferieur' => 'required',
            'titre_superieur' => 'required',
            'desc' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = str_replace(' ', '-', Str::lower($request->titre_superieur)) . '.' . $request->cover->extension();
        $imageName = $request->file('cover')->storeAs('post', $imageName, 'public') ;

        $post->update([
            'sub_title' => $request->titre_inferieur,
            'sup_title' => $request->titre_superieur,
            'content' => $request->desc,
            'cover' => $imageName,
        ]);
        return back()->with('status', $request->titre_superieur . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Post::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
