<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class CommentView extends Component
{
    public $post;
    
    public $commentUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post, $commentUrl)
    {
        $this->post = $post;

        $this->commentUrl = $commentUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment-view');
    }

}
