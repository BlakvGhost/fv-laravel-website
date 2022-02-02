@extends('base.base')
@section('title')
    A propos de Nous
@endsection

@section('main')
<div class="border-top p-3">
    <article class="container-custom my-3">
        <div class="text-end fv-title-normal my-2" style="font-size:22px;">
           Publié {{ Carbon\Carbon::now()->diffForHumans($about->created_at) }}
        </div>
        <blockquote>
            <div class="fv-title-normal fvSlideOn">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; En Savoir Plus Sur Nous </h3>
            </div>
            <div class="fv-title-big">
                <h3 class="text-dark fw-bolder oswald-bold">
                    {{ $about->title }}
                </h3>
            </div>
            <div class="fv-title-normal">
                <div class="text-black-50 p-2">
                    <div style="font-size:22px">
                        {!! $about->content !!}
                    </div>
                    <div class="row row-cols-lg-2 row-cols-sm-1" style="font-size:22px">
                        <div class="col col-lg-6 col-sm-12">
                            <div class="text-fv-primary">
                                <i class="mdi mdi-certificate-outline mdi-36px align-middle"></i>
                            </div>
                            <div class="fv-title-big border-bottom py-2 px-1" style="width: fit-content;">
                                <h6 class="text-black fw-bolder oswald-bold">Experience</h6>
                            </div>
                            <div class="fv-title-normal py-2 fvSlideOn">
                                <h5 class="text-black-50">{{ $about->experience }} </h5>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-sm-12 fvSlideOn">
                            <div class="text-fv-primary">
                                <i class="mdi mdi-timer-cog-outline mdi-36px align-middle"></i>
                            </div>
                            <div class="fv-title-big border-bottom py-2 px-1" style="width: fit-content;">
                                <h6 class="text-black fw-bolder oswald-bold">Support Rapide</h6>
                            </div>
                            <div class="fv-title-normal py-2">
                                <h5 class="text-black-50">{{ $about->support }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid h-75 fv-p-0-sm">
                        <div class="row w-100 h-100 fv-f-direc-col-sm fv-m-0-sm">
                            @foreach ($about->galleries as $img)
                                <div class="fv-img-fluid col col-6 p-2 fv-w-100-sm">
                                    <img src="{{ Storage::url($img->cover) }}" alt="{{ $img->name }}" title="{{ $img->name }}" class="shadow img-thumbnail">
                                </div>
                            @endforeach               
                        </div>
                    </div>
                </div>
            </div>
        </blockquote>
        @include('partials.ContactUs')
    </article>
</div>
@endsection