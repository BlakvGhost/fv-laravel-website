<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class BlogUnique extends Component
{
    public $styleCustom;
    
    public $bgStyleCustom;

    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($styleCustom, $bgStyleCustom, $post)
    {
        $this->styleCustom = $styleCustom;
        $this->bgStyleCustom = $bgStyleCustom;
        $this->post = $post;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog-unique');
    }
}
