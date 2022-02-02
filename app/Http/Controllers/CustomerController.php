<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.customer', [
            'posts' => Customer::all()->sortByDesc('id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customer-add');
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
            'Titre' => 'required',
            'Description' => 'required',
            'Logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->file('Logo')){
            $imageName = str_replace(' ', '-', Str::lower($request->Nom)) . '.' . $request->Logo->extension();
            $imageName = $request->file('Logo')->storeAs('customers', $imageName, 'public') ;
        }

        $post = Customer::create([
            'name' => $request->Nom,
            'title' => $request->Titre,
            'icon' => $request->Icon,
            'content' => $request->Description,
            'logo' => $imageName,
        ]);
        return back()->with('status', $post->name . " publié avec sucess !");  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customer-edit', [
            'post' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'Nom' => 'required',
            'Titre' => 'required',
            'Description' => 'required',
        ]);

        $imageName = $customer->logo;
        if ($request->file('Logo')){
            $imageName = str_replace(' ', '-', Str::lower($request->Nom)) . '.' . $request->Logo->extension();
            $imageName = $request->file('Logo')->storeAs('customers', $imageName, 'public') ;
        }

        $post = Customer::create([
            'name' => $request->Nom,
            'title' => $request->Titre,
            'icon' => $request->Icon,
            'content' => $request->Description,
            'logo' => $imageName,
        ]);
        return back()->with('status', $post->name . " publié avec sucess !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $keys = $request->except('_token');
        foreach ($keys as $id => $key) {
            Customer::find($id)->delete();
        }
        return back()->with('status', count($keys) . " elements supprimés");
    }
}
