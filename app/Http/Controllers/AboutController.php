<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.about', [
            'posts' => About::all()->sortByDesc('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.about-add', [
            'galleries' => Gallery::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'experience' => 'required',
            'support' => 'required',
            'content' => 'required',
            'cover' => 'required',
        ]);

        $post = About::create($request->post());
        $post->galleries()->attach($request->post('cover'));

        return back()->with('status', $post->title . " publié avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\About $about
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('about', [
            'about' => About::all()->sortByDesc('id')->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\About $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('dashboard.about-edit', [
            'galleries' => Gallery::all(),
            'post' => $about,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\About $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'title' => 'required',
            'experience' => 'required',
            'support' => 'required',
            'content' => 'required',
            'cover' => 'required',
        ]);

        $about->update($request->post());
        $about->galleries()->attach($request->post('cover'));

        return back()->with('status', $request->title . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            About::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
