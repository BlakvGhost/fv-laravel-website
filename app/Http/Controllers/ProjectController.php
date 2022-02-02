<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.project', [
            'posts' => Project::all()->sortByDesc('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.project-add');
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
            'Nom' => 'required',
            'URL' => 'required',
            'Category' => 'required',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = str_replace(' ', '-', Str::lower($request->Nom)) . '.' . $request->Image->extension();
        $imageName = $request->file('Image')->storeAs('project', $imageName, 'public') ;

        $post = Project::create([
            'name' => $request->Nom,
            'link' => $request->URL,
            'cat' => $request->Category,
            'cover' => $imageName,
        ]);
        return back()->with('status', $post->name . " publié avec sucess !");   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('dashboard.project-edit', [
            'post' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'Nom' => 'required',
            'URL' => 'required',
            'Category' => 'required',
            'Image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $project->cover;
        if ($request->file('Image')){
            $imageName = str_replace(' ', '-', Str::lower($request->Nom)) . '.' . $request->Image->extension();
            $imageName = $request->file('Image')->storeAs('project', $imageName, 'public') ;
        }

        $project->update([
            'name' => $request->Nom,
            'link' => $request->URL,
            'cat' => $request->Category,
            'cover' => $imageName,
        ]);
        return back()->with('status', $request->name . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Project::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
