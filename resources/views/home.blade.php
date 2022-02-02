@extends('base.base')
@section('title')
    Acceuil
@endsection

@section('main')
<div id="b" class="slideshow w-100 overflow-hidden position-relative" style="height: 500px;">
    <div class="h-100">
        <div class="carousel-control position-absolute start-0 text-white w-100" style="bottom: 10%;z-index: 5">
            <div class="container-custom">
                <div class="" style="width: 150px;">
                    <div class="row row-cols-3 flex-nowrap w-100">
                        <div class="fv-carousel-control-prev col align-self-center">
                            <a role="button" class="btn">
                                <i class="mdi mdi-arrow-left-thin mdi-light"></i>
                            </a>
                        </div>
                        <div class="fv-carousel-numerous col d-flex flex-nowrap align-self-center">
                            <span id="currentSlide">1</span>
                            <span>/</span>
                            <span>{{ $carousel->count() }}</span>
                        </div>
                        <div class="fv-carousel-control-next col align-self-center">
                            <a role="button" class="btn">
                                <i class="mdi mdi-arrow-right-thin mdi-light"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-inner h-100 w-100 home-slide owl-carousel d-flex">
            @foreach ($carousel as $slid)
                <div class="carousel-item active h-100 w-100">
                    <div class="position-absolute start-0 top-0 full rank" style="background-image: url('{{ Storage::url($slid->cover) }}');" >
                        <div class="full opacity-75 bg-dark"></div>                  
                    </div>
                    <div class="position-absolute start-0 text-white h-100 w-100" style="top: 16%;">
                        <div class="container-custom">
                            <div class="fv-slide-title">
                                <div class="fv-slide-title-normal">
                                    <h3><span class="dbslash">//</span> &nbsp; {{ $slid->sub_title }} </h3>
                                </div>
                                <div class="fv-slide-title-big">
                                    <h1 class="text-uppercase fa-3x fw-bolder write"> {{ $slid->sup_title}} </h1>
                                </div>
                                <div class="fv-slide-title-normal">
                                    <h4>{{ Str::limit($slid->content, 150, ' ...') }}</h4>
                                </div>
                                <div style="width: 150px;" class="mt-4">
                                    <a href="{{ route('post.show', [$slid, str_replace(' ', '-', Str::lower($slid->sup_title)) ]) }}" class="btn btn-custom w-100 text-white fw-bold">LEARN MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div id="c" class="fv-partners bg-third">
    <div class="container-custom overflow-hidden">
        <div class="swiper swiper-partner">
            <div class="swiper-wrapper">
                @foreach ($partners as $partner)
                    <div class="swiper-slide fv-w-25-lg fv-w-50-sm">
                        <div class="fv-p-4-lg fv-p-3-sm">
                            <a href="javascript:void(0)" class="text-black-50 text-decoration-none" data-aos-anchor-placement="bottom-center">
                                <h4 class="m-0">
                                    @if ($partner->logo)
                                        <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" title="{{ $partner->name }}" style="width:34px; max-height:40px;">
                                    @else
                                        <i class="mdi {{ $partner->icon }} align-middle" title="{{ $partner->name }}"></i>
                                    @endif                                  
                                    {{ $partner->name }}
                                </h4>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div id="d" class="w-100 py-3">
    <div class="container-custom my-4">
        <div class="row row-cols-lg-2 row-cols-sm-1 fv-f-direc-col-sm">
            <div class="col col-lg-6 col-sm-12 fv-w-100-sm">
                <div class="fv-title-normal fvSlideOn" data-aos-anchor-placement="bottom-center">
                    <h3 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;A propos de Nous </h3>
                </div>
                <div class="fv-title-big fvSlideOn" data-aos-anchor-placement="bottom-center">
                    <h3 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="{{ $about->title }}"></h3>
                </div>
                <div class="fv-title-normal fvSlideOn" data-aos-anchor-placement="bottom-center">
                    <h4 class="text-black-50">
                        {{ Str::limit($about->content, 100, '...') }}
                    </h4>
                </div>
                <div class="row row-cols-lg-2 row-cols-sm-1">
                    <div class="col col-lg-6 col-sm-12">
                        <div class="text-fv-primary">
                            <i class="mdi mdi-certificate-outline mdi-36px align-middle"></i>
                        </div>
                        <div class="fv-title-big border-bottom py-2 px-1 fvSlideOn" style="width: fit-content;" data-aos-anchor-placement="bottom-center">
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
            </div>
            <div class="col col-lg-6 col-sm-12 fv-w-100-sm">
                <div class="container-fluid fv-h-75-lg fv-h-100-sm fv-p-0-sm">
                    <div class="row w-100 h-100 fv-m-0-sm">
                        @foreach ($about->galleries as $img)
                            <div class="fv-img-fluid col col-6 p-2 fv-w-50-sm" data-aos="fade-right">
                                <img src="{{ Storage::url($img->cover) }}" alt="{{ $img->name }}" title="{{ $img->name }}" class="shadow img-thumbnail">
                            </div>
                        @endforeach                   
                    </div>
                </div>
                <div class="w-100 h-auto p-3">
                    <a href="{{ route('about.show') }}" class="text-fv-secondary text-decoration-none fvSlideOn">
                        <i class="mdi mdi-arrow-right-thin align-middle"></i>
                        &nbsp;
                        <span class="text-uppercase">Apprendre plus sur Nous !</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="e" class="w-100 py-3 header-color text-white fvSlideOn">
    <div class="container-custom my-4 position-relative">
        <div class="text-center fv-w-50-lg fv-w-100-sm m-auto">
            <div class="fv-title-normal fvSlideOn">
                <h4 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;Pourquoi nous choisir ? </h4>
            </div>
            <div class="fv-title-big">
                <h3 class="fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Design the Concept of Your Business Now"></h3>
            </div>
        </div>
        <div class="w-100 mb-5 pb-3">
            <div class="container-fluid p-0">
                <div class="row fv-f-direc-col-sm">
                    @foreach ($exploits as $wu)
                    <div data-aos="fade-left" class="card border-0 overflow-hidden fv-hov-light col shadow bg-primary-x fv-p-3-lg fv-m-2-lg fv-my-2-sm fv-mx-auto-sm position-relative fv-w-75-sm rounded-3">
                        <div class="position-absolute start-0 top-0 opacity-25 p-2">
                            <div class="fv-title-big opacity-50 fvSlideOn">
                                <h1 class="fw-bolder fa-3x oswald-bold" data-fv-anim='countdown' data-fv-data='{{ $wu->value }}'></h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="fv-title-big">
                                <h6 class="fw-bolder oswald-bold"> {{ $wu->name}} </h6>
                            </div>
                            <div class="fv-title-normal">
                                <h6 class="text-white-50">{{ Str::limit($about->content, 100, '...') }}</h6>
                            </div>
                            <div class="py-2 x-trans-div">
                                <a href="{{ route('exploit.show', [$wu, str_replace(' ', '-', Str::lower($wu->name))]) }}" class="text-fv-secondary text-decoration-none x-trans-link p-2 rounded-pill">
                                    <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                    &nbsp;
                                    <span class="text-uppercase">Apprendre Plus</span>
                                </a>
                            </div>
                        </div>
                        <div class="position-absolute end-0 bottom-0" data-aos="fade-right">
                            <div class="bg-opacity-25 p-2 bg-light" style="border-top-left-radius: 50%;">
                                <div class="text-white">
                                    <i class="mdi {{ $wu->icon }} mdi-36px align-middle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach                    
                </div>
            </div>
        </div>
        <div class="fv-position-absolute-lg start-0 w-100" style="bottom: -35%;height: 133px;">
            <div class="container-fluid">
                <div class="row fv-f-direc-col-sm">
                    <div class="col shadow mx-2 position-relative fv-my-2-sm fvSlideOn">
                        <div class="position-absolute start-0 top-0 full rank" style="background-image: url({{ asset('img/team.jpg') }});" >
                            <div class="full opacity-75 bg-dark"></div>                  
                        </div>
                        <div class="text-white h-100 w-100">
                            <div class="p-3">
                                <div class="fv-slide-title">
                                    <div class="fv-slide-title-big fvSlideOn">
                                        <h4 class="fw-bolder oswald-bold"><span class='fw-bolder oswald-bold' data-fv-anim='countdown' data-fv-data='5'></span>ans</h4>
                                    </div>
                                    <div class="fv-slide-title-big fvSlideOn">
                                        <h5 class="fw-bolder oswald-bold">Annee d'Experience</h5>
                                    </div>
                                    <div class="fv-slide-title-normal fvSlideOn">
                                        <h6>Lorem ipsum dolor sit amet,es quia similique? Dignissimos provident quia .</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow mx-2 position-relative fv-my-2-sm">
                        <div class="position-absolute start-0 top-0 full rank" style="background-image: url({{ asset('img/team.jpg') }});" >
                            <div class="full opacity-75 bg-dark"></div>                  
                        </div>
                        <div class="text-white h-100 w-100">
                            <div class="p-3">
                                <div class="fv-slide-title">
                                    <div class="fv-slide-title-big fvSlideOn">
                                        <h4 class="fw-bolder oswald-bold"><span class='fw-bolder oswald-bold' data-fv-anim='countdown' data-fv-data='8'></span>k</h4>
                                    </div>
                                    <div class="fv-slide-title-big fvSlideOn">
                                        <h5 class="fw-bolder oswald-bold">Clients Satisfait</h5>
                                    </div>
                                    <div class="fv-slide-title-normal fvSlideOn">
                                        <h6>Lorem ipsum dolor sit amet,es quia similique? Dignissimos provident quia .</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="f" class="pt-5 mb-5 fv-my-6-sm">
    <div class="container-custom my-5 pb-3 position-relative">
        <div class="row row-cols-2">
            <div class="col">
                <div class="fv-title-normal fvSlideOn">
                    <h3 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;Nos services </h3>
                </div>
                <div class="fv-title-big fvSlideOn">
                    <h3 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Nous offrons plusieurs solutions dans le numerique"></h3>
                </div>
            </div>
            <div class="col text-end align-self-end fvSlideOn" id="allService">
                <a href="{{ route('service.all') }}" class="btn btn-custom text-white fw-bold">TOUT NOS SERVICES</a>
            </div>
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
        <div class="fv-position-absolute-lg start-0 w-100 fv-h-100-sm" style="bottom: -35%;height: 150px;">
            <div class="shadow p-3 position-relative full">
                <div class="position-absolute start-0 top-0 full rank" style="background-image: url({{ asset('img/team.jpg') }});" >
                    <div class="full opacity-75 bg-dark">
                    </div>                    
                </div>
                <div class="containter-fluid full">
                    <div class="row row-cols-2 mb-4">
                        <div class="col">
                            <div class="fv-title-normal fvSlideOn">
                                <h3 class="text-light m-auto"><span class="dbslash">//</span> Nous Somme Plus Qu'une stucture de coding</h3>
                            </div>
                            <div class="fv-title-big fvSlideOn">
                                <h4 class="text-white fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Laisser nous vous developpez vos applications"></h4>
                            </div>
                        </div>
                        <div class="col text-end align-self-end fvSlideOn">
                            <a href="{{ route('contact') }}" class="btn btn-outline-light fw-bold">Nous Contacter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="g" class="fv-py-5-lg bg-third">
    <div class="container-custom my-5 position-relative py-3 fv-text-center-sm">
        <div class="row row-cols-2 mt-4 fvSlideOn">
            <div class="col fv-w-100-sm">
                <div class="fv-title-normal fvSlideOn">
                    <h4 class="text-uppercase text-fv-primary m-auto"><span class="dbslash">//</span> &nbsp; derniers projets realisés </h4>
                </div>
                <div class="fv-title-big fvSlideOn">
                    <h4 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Introduce Our Projects"></h4>
                </div>
            </div>
            <div class="col text-black-50  fv-w-100-sm">
                <h5 class="m-auto">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aspernatur atque consequatur culpa deserunt eaque e.</h5>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="" style="overflow-x: hidden">
            <div class="swiper swiper-partner">
                <div class="swiper-wrapper" style="height: 200px;">
                    @foreach ($projects as $pj)
                        <div class="swiper-slide fv-w-25-lg fv-w-100-sm h-100 fv-mx-3-lg position-relative" data-aos="zoom-out-down">
                            <div class="card h-100 overflow-hidden fvSlideOn">
                                <div class="card-body p-0">
                                    <div class="fv-img-fluid w-100 h-100">
                                        <img src="{{ Storage::url($pj->cover) }}" alt="{{ $pj->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute start-0 w-100 fvSlideOn" style="bottom: -15%;">
                                <div class="shadow position-relative h-100 w-75 m-auto header-color overflow-hidden fv-hov-light" style="border-top-left-radius: 30%;border-bottom-right-radius: 30%">
                                    <div class="p-3">
                                        <div class="fv-title-big">
                                            <h6 class="text-white fw-bolder oswald-bold"> {{ $pj->name }} </h6>
                                        </div>
                                        <div class="fv-title-normal">
                                            <h6 class="text-white-50 text-uppercase"> {{ $pj->cat }} </h6>
                                        </div>
                                    </div>
                                    <div class="position-absolute end-0 top-0 fvSlideOn">
                                        <div class="bg-opacity-25 p-2 bg-light" style="border-bottom-left-radius: 50%;">
                                            <div class="text-white">
                                                <a href="{{ $pj->link }}" class="text-white text-decoration-none"><i class="mdi mdi-arrow-right-thin align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagin text-center mt-5 p-3"></div>
            </div>
        </div>
    </div>
</div>
<div id="h" class="w-100 text-white position-relative">
    <div class="position-absolute start-0 top-0 full rank" style="background-image: url({{ asset('img/team.jpg') }});" >
        <div class="full opacity-75 bg-dark"></div>                    
    </div>
    <div class="container-custom py-4 position-relative fvSlideOn">
        <div class="text-center fv-w-50-lg m-auto">
            <div class="fv-title-normal fvSlideOn">
                <h4 class="text-uppercase"><span class="dbslash">//</span> &nbsp;technology index </h4>
            </div>
            <div class="fv-title-big mb-3 fvSlideOn">
                <h4 class="fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="We Deliver Solution With The Goal of Trusting Relationships"></h4>
            </div>
        </div>
        <div class="w-100 py-4">
            <div class="container-fluid p-2">
                <div class="row justify-content-between">
                    @foreach ($technologies as $tech)
                        <button class="col btn btn-outline-light text-center m-2  fv-w-100-sm" style="width: 90px;height: 90px;">
                            <div class="">
                                <i class="mdi {{ $tech->icon }} mdi-24px"></i>
                            </div>
                            <div class="fv-title-big">
                                <h6 class="fw-bolder text-uppercase oswald-bold m-auto"> {{ $tech->name }} </h6>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div id="i" class="bg-white w-100 text-white">
    <div class="container-custom py-4 overflow-hidden position-relative">
        <div class="text-center fv-w-50-lg mx-auto my-4">
            <div class="fv-title-normal fvSlideOn">
                <h4 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;nos clients </h4>
            </div>
            <div class="fv-title-big mb-3 fvSlideOn">
                <h4 class="fw-bolder oswald-bold text-dark">Nous sommes confirmer dans <span class="oswald-bold text-dark" data-fv-anim='countdown' data-fv-data="24"></span>+ Pays à travers le monde</h4>
            </div>
        </div>
        <div class="swiper swiper-y overflow-hidden my-2" style="width: 90%;margin: auto">
            <div class="swiper-wrapper">
                @foreach ($clients as $cl)
                    <div class="swiper-slide fv-w-50-lg fv-w-100-sm h-100 mx-2 position-relative">
                        <div class="card col rounded-3 shadow bg-primary-x p-2 fv-hov-light fv-h-100-sm fv-text-center-sm" style="height:200px;">
                            <div class="card-header row border-0 fv-f-direc-col-sm">
                                <div class="text-white col col-auto">
                                    @if ($cl->logo)
                                        <img src="{{ Storage::url($cl->logo) }}" alt="{{ $cl->name }}" title="{{ $cl->name }}" style="width:72px; max-height:40px;">
                                    @else
                                        <i class="mdi {{ $cl->icon }} align-middle mdi-24px" title="{{ $cl->name }}"></i>
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="fv-title-big">
                                        <h6 class="fw-bolder oswald-bold">{{ $cl->name }}</h6>
                                    </div>
                                    <div class="fv-title-normal">
                                        <h6 class="text-white-50"> {{ $cl->title }} </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="fv-title-normal">
                                    <h6 class="text-white-50">
                                        {{ $cl->content }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="carousel-control">
            <a href="javascript:void(0)" class="text-dark text-decoration-none position-absolute start-0 y-prev fv-zd" style="top: 60%;">
                <i class="mdi mdi-arrow-left-thin mdi-24px"></i>
            </a>
            <a href="javascript:void(0)" class="text-dark text-decoration-none position-absolute end-0 y-next fv-zd" style="top: 60%;">
                <i class="mdi mdi-arrow-right-thin mdi-24px"></i>
            </a>
        </div>
    </div>
</div>
<div id="j" class="bg-white w-100 text-white">
    <div class="container-custom fv-py-4-lg overflow-hidden position-relative">
        <div class="text-center fv-w-50-lg mx-auto my-4">
            <div class="fv-title-normal fvSlideOn">
                <h4 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;notre equipe </h4>
            </div>
            <div class="fv-title-big mb-3 fvSlideOn">
                <h4 class="fw-bolder oswald-bold text-dark">C'est plus qu'une equipe, c'est une famille de <span class="oswald-bold text-dark" data-fv-anim='countdown' data-fv-data="24"></span> travers le Pays</h4>
            </div>
        </div>
        <div class="swiper swiper-team overflow-hidden my-2" style="width: 90%;margin: auto">
            <div class="swiper-wrapper" style="">
                @foreach ($teams as $tm)
                    <div class="swiper-slide full" data-aos="zoom-out-down">
                        <div class="col p-3  text-center">
                            <div class="text-dark my-2">
                                <blockquote style="font-size:22px;">
                                    {{ $tm->bio }}
                                </blockquote>
                            </div>
                            <div class="text-center text-dark">
                                <div class="my-2">
                                    <img src="{{ Storage::url($tm->avatar) }}" style="width:82px;height:82px" class="rounded-circle img-thumbnail">
                                </div>
                                <div class="fv-title-big">
                                    <h6 class="fw-bolder oswald-bold">{{ $tm->first_name }} {{ $tm->last_name }}</h6>
                                </div>
                                <div class="fv-title-normal" >
                                    <h6 class="text-dark"> {{ $tm->role }} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagin-team text-center mt-5 p-3"></div>
        </div>
        <div class="carousel-control">
            <a href="javascript:void(0)" class="text-dark text-decoration-none position-absolute start-0 team-prev fv-zd" style="top: 60%;">
                <i class="mdi mdi-arrow-left-thin mdi-24px"></i>
            </a>
            <a href="javascript:void(0)" class="text-dark text-decoration-none position-absolute end-0 team-next fv-zd" style="top: 60%;">
                <i class="mdi mdi-arrow-right-thin mdi-24px"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('.home-slide').owlCarousel({
                items : 1,
                nav : false,
                dots : false,
                loop: true,
                autoplay:true,
                autoplaySpeed:1500,
                autoplayTimeout:10000,
                autoHeight:true,
                responsive: {
                    1279: {
                        items: 1
                    },
                    1250: {
                        items: 1
                    },
                    600: {
                        items: 1
                    }
                }
            });
            $('.home-slide').on('changed.owl.carousel', (ev) => {
                $('#currentSlide').text(ev.item.index - 1);
            });

            $('.fv-carousel-control-prev').click(function(){
                $('.home-slide .owl-prev').click();
            });
            $('.fv-carousel-control-next').click(function(){
                $('.home-slide .owl-next').click();
            });
            new Swiper('.swiper-partner', {
                direction: 'horizontal',
                loop: false,
                pagination: {
                    el: '.pagin',
                    clickable: true,
                },
            });
            new Swiper('.swiper-team', {
                direction: 'horizontal',
                loop: true,
                pagination: {
                    el: '.pagin-team',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.team-next',
                    prevEl: '.team-prev',
                }
            });
            new Swiper('.swiper-y', {
                direction: 'horizontal',
                loop: true,
                navigation: {
                    nextEl: '.y-next',
                    prevEl: '.y-prev',
                }
            });   
    </script>
@endsection