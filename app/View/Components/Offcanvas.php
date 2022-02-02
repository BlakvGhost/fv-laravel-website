<?php

namespace App\View\Components;

use App\Models\About;
use App\Models\Service;
use Illuminate\View\Component;

class Offcanvas extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.offcanvas', [
            'services' => Service::all()->sortByDesc('id')->take(5),
            'about' => About::all()->sortByDesc('id')->first(),
        ]);
    }
}
