<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

use function PHPUnit\Framework\isEmpty;

class ReactPost extends Component
{
    public $post;

    public $liked ;

    public $unLiked;

    public $commented;

    public $viewed;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;

    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user_id = Auth::user()->id ?? null;
        $this->liked = $this->post->likes->filter(fn ($value, $key) => $value->user_id == $user_id && $value->type == 'like')->count();
        $this->unLiked = $this->post->likes->filter(fn ($value, $key) => $value->user_id == $user_id && $value->type == 'unlike')->count();
        $this->commented = $this->post->comments->filter(fn ($value, $key) => $value->user_id == $user_id)->count();
        $this->viewed = $this->post->viewers->filter(fn ($value, $key) => $value->ipaddress == Request::ip() && $this->post->id == $value->viewable_id)->count();

        return view('components.react-post');
    }
}
