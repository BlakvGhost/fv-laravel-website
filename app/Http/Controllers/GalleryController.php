<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.gallery', [
            'posts' => Gallery::all()->sortByDesc('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.gallery-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = str_replace(' ', '-', Str::lower($request->name)) . '.' . $request->cover->extension();
        $imageName = $request->file('cover')->storeAs('gallery', $imageName, 'public') ;

        $post = Gallery::create([
            'title' => $request->name,
            'cover' => $imageName,
        ]);
        return back()->with('status', $post->title . " publié avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('dashboard.gallery-edit', [
            'post' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = str_replace(' ', '-', Str::lower($request->name)) . '.' . $request->cover->extension();
        $imageName = $request->file('cover')->storeAs('gallery', $imageName, 'public') ;

        $gallery->update([
            'title' => $request->name,
            'cover' => $imageName,
        ]);
        return back()->with('status', $gallery->title . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gallery $gallery
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Gallery::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
