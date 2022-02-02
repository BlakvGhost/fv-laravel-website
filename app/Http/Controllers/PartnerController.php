<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.partner', [
            'posts' => Partner::all()->sortByDesc('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.partner-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|Factory|View
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->logo) {
            $imageName = str_replace(' ', '-', Str::lower($request->name)) . '.' . $request->logo->extension();
            $imageName = $request->file('logo')->storeAs('partners', $imageName, 'public') ;
        }

        $post = Partner::create([
            'name' => $request->name,
            'logo' => $imageName,
            'icon' => $request->icon,
        ]);
        return back()->with('status', $post->name . " publié avec sucess !");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Partner $partner
     * @return Application|Factory|View
     */
    public function show(Partner $partner)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Partner $partner
     * @return Application|Factory|View
     */
    public function edit(Partner $partner)
    {
        return view('dashboard.partner-edit', [
            'post' => $partner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partner $partner
     * @return Application|Factory|View
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $partner->logo;
        if ($request->logo) {
            $imageName = str_replace(' ', '-', Str::lower($request->name)) . '.' . $request->logo->extension();
            $imageName = $request->file('logo')->storeAs('partners', $imageName, 'public') ;
        }

        $partner->update([
            'name' => $request->name,
            'logo' => $imageName,
            'icon' => $request->icon,
        ]);
        return back()->with('status', $request->name . " edité avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Partner $partner
     * @return Application|Factory|View
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Partner::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
