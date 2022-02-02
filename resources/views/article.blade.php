@extends('base.base')
@section('title')
    {{ $post->sup_title }}
@endsection

@section('main')
<div class="border-top p-3">
    <article class="container-custom my-3">
        <div class="text-end fv-title-normal my-2" style="font-size:22px;">
           Publié {{ $post->created_at }}
        </div>
        <blockquote>
            <div class="fv-title-normal fvSlideOn">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; {{ $post->sub_title }} </h3>
            </div>
            <div class="fv-title-big fvSlideOn">
                <h3 class="text-dark fw-bolder oswald-bold">
                    {{ $post->sup_title }}
                </h3>
            </div>
            <div class="fv-title-normal">
                <blockquote class="text-black-50 fv-p-2-lg">
                    <div style="font-size:22px">
                        {{ $post->content }}
                    </div>
                    <div style="height:500px; width:100%;" class="my-3 w300">
                        <img src="{{ Storage::url($post->cover) }}" alt="{{ $post->sup_title }}" style="height:100%; width:100%;">
                    </div>
                </blockquote>
            </div>
        </blockquote>
        <div class="my-3 border-top">
            <div class="p-2" style="font-size:22px">
                <p>Partager: </p>
                <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-facebook"></i></a>
                <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-twitter"></i></a>
                <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-whatsapp"></i></a>
                <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-linkedin"></i></a>
            </div>
        </div>
        @include('partials.ContactUs')
    </article>
</div>
@endsection