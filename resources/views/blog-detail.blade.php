@extends('base.base')
@section('title')
    {{ $post->title }}
@endsection

@section('main')
<div class="border-top p-3">
    <div class="container-custom my-3">
        <div class="fv-title-normal fvSlideOn my-3">
            <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Blog / {{ $post->title }} </h3>
        </div>     
        <x-search></x-search>
        <article class=" my-3">
            <div class="text-end fv-title-normal" style="font-size:22px;">
            Publié {{ Carbon\Carbon::now()->diffForHumans($post->created_at) }} | <strong>{{ $post->user->first_name . ' ' . $post->user->last_name }}</strong>
            </div>
            <blockquote>
                <div class="fv-title-big">
                    <h3 class="text-dark fw-bolder oswald-bold">
                        {{ $post->title }}
                    </h3>
                </div>
                <div class="fv-title-normal">
                    <blockquote class="text-black-50 fv-p-2-lg fv-py-4-sm">
                        <div style="height:400px; width:100%;" class="my-3 w300">
                            <img src="{{ Storage::url($post->cover) }}" alt="{{ $post->title}} " style="height:100%; width:100%;">
                        </div>
                        <div style="font-size:22px">
                            {!! $post->content !!}
                        </div>                            
                    </blockquote>
                </div>
            </blockquote>
            @include('partials.comment')
            {{-- <x-comment-view :post="$post" :comment-url="route('blog.comment', $post)"></x-comment-view> --}}
            @if ($similars->count() > 0)
                <div class="my-3 container-fluid">
                    <div class="fv-title-big fvSlideOn">
                        <h2 class="text-dark fw-bolder">Publications Similaires</h2>
                    </div>
                    <div class="row fv-f-direc-col-sm">
                        @foreach($similars as $post)
                            <x-blog-unique :post="$post" style-custom="height:290px;" bg-style-custom="height:100px;"></x-blog-unique>
                        @endforeach
                    </div>
                </div>
            @endif
        </article>       
    </div>
</div>
@endsection