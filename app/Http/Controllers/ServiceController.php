<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.service', [
            'posts' => Service::all()->sortByDesc('id'),
        ]);
    }

    public function all()
    {
        return view('services', [
            'services' => Service::all()->sortByDesc('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.service-add');
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
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        $imageName = null;
        if ($request->logo) {
            $imageName = str_replace(' ', '-', Str::lower($request->name)) . '.' . $request->logo->extension();
            $imageName = $request->file('logo')->storeAs('service', $imageName, 'public') ;
        }

        $post = Service::create([
            'name' => $request->name,
            'logo' => $imageName,
            'icon' => $request->icon,
            'content' => $request->content,
        ]);
        return back()->with('status', $post->name . " publié avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('service', [
            'service' => $service,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('dashboard.service-edit', [
            'post' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ]);

        $imageName = null;
        if ($request->logo) {
            $imageName = str_replace(' ', '-', Str::lower($request->name)) . '.' . $request->logo->extension();
            $imageName = $request->file('logo')->storeAs('service', $imageName, 'public') ;
        }

        $service->update([
            'name' => $request->name,
            'logo' => $imageName,
            'icon' => $request->icon,
            'content' => $request->content,
        ]);
        return back()->with('status', $request->name . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Service::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
