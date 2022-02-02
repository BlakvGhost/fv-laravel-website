<article class="col col-4 my-2 fv-w-100-sm" style="{{ $styleCustom }}">
    <div class="full rounded overflow-hidden">
        <div class="w-100 rank" style="background-image: url('{{ Storage::url($post->cover) }}');{{ $bgStyleCustom }}"></div>
        <div class="">
            <div class="my-2 fvSlideOn" style="font-size:22px">
                <a href="{{ route('blog.show', [$post, str_replace([' ', "'", '*'], '-', Str::lower($post->title)) ]) }}" class="btn btn-warning text-uppercase" title="{{ $post->category->desc }}">{{ $post->category->name }}</a>
                <span class="text-dark ps-1 text-decoration-underline">{{ Carbon\Carbon::now()->diffForHumans($post->created_at) }} </span>
            </div>
            <div class="text-dark fvSlideOn">
                <a href="{{ route('blog.show', [$post, str_replace([' ', "'", '*', '-'], '-', Str::lower($post->title)) ]) }}" class="text-decoration-none text-dark">
                    <h4> {{ Str::limit($post->title, 40, '...') }} </h4>
                </a>
            </div>
        </div>
        <div class="mt-2">
            <x-react-post :post="$post"></x-react-post>
        </div>
    </div>
</article>