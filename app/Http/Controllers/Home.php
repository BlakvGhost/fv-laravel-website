<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Customer;
use App\Models\Exploit;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use App\Models\Technology;
use Illuminate\Http\Request;

class Home extends Controller
{

    public function index()
    {
        $context = [
            'carousel' => Post::all()->sortByDesc('id'),
            'partners' => Partner::all()->sortByDesc('id'),
            'about' => About::all()->sortByDesc('id')->first(),
            'services' => Service::all()->take(6)->sortByDesc('id'),
            'projects' => Project::all()->sortByDesc('id'),
            'teams' => Team::all()->sortByDesc('id'),
            'technologies' => Technology::all()->sortByDesc('id'),
            'clients' => Customer::all()->sortByDesc('id'),
            'exploits' => Exploit::all()->sortByDesc('id'),
        ];
        
        return view('home', $context);
    }
}
