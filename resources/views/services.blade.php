@extends('base.base')
@section('title')
    Nos-Services
@endsection

@section('main')
<div class="border-top p-3">
    <article class="container-custom my-3">
        <div class="container-fluid">
            <div class="fv-title-normal fvSlideOn">
                    <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp;  NOS SERVICES</h3>
                </div>
            <div class="row row-cols-3 my-3 fv-f-direc-col-sm">
                @foreach ($services as $sv)
                <div class="col py-3 fv-px-3-lg fv-hov fv-w-100-sm fv-mx-auto-sm fv-my-2-sm">
                    <div class="container-fluid p-0">
                        <a href="{{ route('service.show', [$sv , str_replace(' ', '-', Str::lower($sv->name))]) }}" class="text-decoration-none">
                            <div class="row">
                                <div class="col col-auto">
                                    @if ($sv->logo)
                                        <img src="{{ Storage::url($sv->logo) }}" alt="{{ $sv->name }}" title="{{ $sv->name }}" style="width:34px; max-height:40px;">
                                    @else
                                        <i class="mdi {{ $sv->icon }} align-middle mdi-36px text-fv-primary" title="{{ $sv->name }}"></i>
                                    @endif
                                </div>
                                <div class="px-2 col">
                                    <div class="fv-title-big">
                                        <h6 class="fw-bold oswald-bold text-dark"> {{ $sv->name }} </h6>
                                    </div>
                                    <div class="fv-title-normal">
                                        <h6 class="text-black-50"> {{ Str::limit($sv->content, 100, '...') }} </h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        @include('partials.ContactUs')
    </article>
</div>
@endsection