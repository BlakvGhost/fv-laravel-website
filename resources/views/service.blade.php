@extends('base.base')
@section('title')
    {{ $service->name }} | Nos-Services
@endsection

@section('main')
<div class="border-top p-3">
    <article class="container-custom my-3">
        <div class="fv-title-normal fvSlideOn">
            <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp;  NOS SERVICES </h3>
        </div>
        <div class="fv-title-big">
            <h3 class="text-dark fw-bolder oswald-bold">
                @if ($service->logo)
                    <img src="{{ Storage::url($service->logo) }}" alt="{{ $service->name }}" title="{{ $service->name }}" style="width:55px; max-height:40px;">
                @else
                    <i class="mdi {{ $service->icon }} align-middle mdi-36px text-fv-primary" title="{{ $service->name }}"></i>
                @endif
              | {{ $service->name }}
            </h3>
        </div>
        <div class="fv-title-normal fvSlideOn">
            <blockquote class="text-black-50 fv-p-2-lg fv-py-4-sm">
                <div style="font-size:22px">
                    {{ $service->content }}
                </div>
            </blockquote>
        </div>
        @include('partials.ContactUs')
    </article>
</div>
@endsection