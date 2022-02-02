<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.team', [
            'posts' => Team::all()->sortByDesc('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.team-add');
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
            'Prenom' => 'required',
            'Role' => 'required',
            'Biographie' => 'required',
            'Photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = str_replace(' ', '-', Str::lower($request->Nom . $request->Prenom)) . '.' . $request->Photo->extension();
        $imageName = $request->file('Photo')->storeAs('teams', $imageName, 'public') ;

        $post = Team::create([
            'first_name' => $request->Prenom,
            'last_name' => $request->Nom,
            'role' => $request->Role,
            'bio' => $request->Biographie,
            'avatar' => $imageName,
        ]);
        return back()->with('status', $post->role . " publié avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('dashboard.team-edit', [
            'post' => $team,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'Nom' => 'required',
            'Prenom' => 'required',
            'Role' => 'required',
            'Biographie' => 'required',
            'Photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $team->avatar;
        if ($request->file('Photo')){
            $imageName = str_replace(' ', '-', Str::lower($request->Nom . $request->Prenom)) . '.' . $request->Photo->extension();
            $imageName = $request->file('Photo')->storeAs('teams', $imageName, 'public') ;
        }

        $team->update([
            'first_name' => $request->Prenom,
            'last_name' => $request->Nom,
            'role' => $request->Role,
            'bio' => $request->Biographie,
            'avatar' => $imageName,
        ]);
        return back()->with('status', $request->Role . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Team::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
