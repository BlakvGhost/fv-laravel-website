<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.blog', [
            'posts' => Blog::latest(),
        ]);
    }

    public function all()
    {
        return view('blog', [
            'posts' => Blog::all()->sortByDesc('id'),
            'categories' => Category::all()->sortByDesc('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blog-add', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'screen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        $imageName = str_replace([' ', '.', '*', ',', "'"] , '-', Str::lower($request->title)) . '.' . $request->screen->extension();
        $imageName = $request->post('cover', $request->file('screen')->storeAs('blog', $imageName, 'public'));

        $post = Blog::create(array_merge($request->post(), ['cover' => $imageName]));
        return back()->with('status', $post->title . " publié avec sucess !");
    }

    public function comment(Request $request, Blog $blog)
    {
        $request->validate(['content' => 'required']);

        $blog->comments()->save(new Comment($request->post()));

        return back()->with('status', $blog->title . " commenté avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $post = Blog::all()->where('category_id', '=', $blog->category_id)->take(10)->filter(fn ($value, $key) => $value->id != $blog->id);
        return view('blog-detail', [
            'post' => $blog,
            'similars' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('dashboard.blog-edit', [
            'categories' => Category::all(),
            'post' => $blog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'screen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $blog->cover;
        if ($request->file('screen')){
            $imageName = str_replace([' ', '.', '*', ',', "'"], '-', Str::lower($request->title)) . '.' . $request->screen->extension();
            $imageName = $request->file('screen')->storeAs('blog', $imageName, 'public');
        }

        $blog->update(array_merge($request->post(), ['cover' => $imageName]));
        return back()->with('status', $request->title . " editer avec sucess !");   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Blog::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }

}
