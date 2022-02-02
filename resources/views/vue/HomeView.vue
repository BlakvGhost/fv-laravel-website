<script setup>
    import Blog from "@/components/Blog.vue";
    import Forum from "../components/Forum.vue";
</script>
<template>

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
                            <span> {{ currentSlide }} </span>
                            <span>/</span>
                            <span>{{ carousel.length }}</span>
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
                <div class="carousel-item active h-100 w-100" v-for="slid in carousel" :key="slid.id">
                    <div class="position-absolute start-0 top-0 full rank" :style="`background-image: url('${slid.cover}');`" >
                        <div class="full opacity-75 bg-dark"></div>                  
                    </div>
                    <div class="position-absolute start-0 text-white h-100 w-100" style="top: 16%;">
                        <div class="container-custom">
                            <div class="fv-slide-title">
                                <div class="fv-slide-title-normal" :class="'fvSlideOn'">
                                    <h3><span class="dbslash">//</span> &nbsp; {{ slid.sub_title }} </h3>
                                </div>
                                <div class="fv-slide-title-big" :class="'fvSlideOn'">
                                    <h1 class="text-uppercase fa-3x fw-bolder write"> {{slid.sup_title}} </h1>
                                </div>
                                <div class="fv-slide-title-normal" :class="'fvSlideOn'">
                                    <h4>{{ slid.content.slice(0, 150) }}</h4>
                                </div>
                                <div style="width: 150px;" class="mt-4" :class="'fvSlideOn'">
                                    <router-link :to="`/article/${slid.id}/${slid.sup_title}`" class="btn btn-custom w-100 text-white fw-bold">LEARN MORE</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div id="c" class="fv-partners bg-third" :class="'fvSlideOn'">
    <div class="container-custom overflow-hidden">
        <div class="swiper swiper-partner">
            <div class="swiper-wrapper">
                <div class="swiper-slide fv-w-25-lg fv-w-50-sm" v-for="partner in partners" :key="partner">
                    <div class="fv-p-4-lg fv-p-3-sm">
                        <a href="javascript:void(0)" class="text-black-50 text-decoration-none" :class="'fvSlideOn'" data-aos-anchor-placement="bottom-center">
                            <h4 class="m-0">
                                <img v-if="partner.logo" :src="partner.logo" :alt="partner.name" :title="partner.name" style="width:34px; max-height:40px;">
                                <i v-if="partner.icon" :class="`mdi ${partner.icon} align-middle`" :title="partner.name"></i>
                                 {{ partner.name }}
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="d" class="w-100 py-3">
    <div class="container-custom my-4">
        <div class="row row-cols-lg-2 row-cols-sm-1 fv-f-direc-col-sm">
            <div class="col col-lg-6 col-sm-12 fv-w-100-sm">
                <div class="fv-title-normal" :class="'fvSlideOn'" data-aos-anchor-placement="bottom-center">
                    <h3 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;A propos de Nous </h3>
                </div>
                <div class="fv-title-big" :class="'fvSlideOn'" data-aos-anchor-placement="bottom-center">
                    <h3 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' :data-fv-data="about.title"></h3>
                </div>
                <div class="fv-title-normal" :class="'fvSlideOn'" data-aos-anchor-placement="bottom-center">
                    <h4 class="text-black-50">
                        {{ about.content.slice(0, 100) }}
                    </h4>
                </div>
                <div class="row row-cols-lg-2 row-cols-sm-1">
                    <div class="col col-lg-6 col-sm-12">
                        <div class="text-fv-primary">
                            <i class="mdi mdi-certificate-outline mdi-36px align-middle"></i>
                        </div>
                        <div class="fv-title-big border-bottom py-2 px-1" style="width: fit-content;" :class="'fvSlideOn'" data-aos-anchor-placement="bottom-center">
                            <h6 class="text-black fw-bolder oswald-bold">Experience</h6>
                        </div>
                        <div class="fv-title-normal py-2" :class="'fvSlideOn'">
                            <h5 class="text-black-50">{{ about.experience }} </h5>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-sm-12" :class="'fvSlideOn'">
                        <div class="text-fv-primary">
                            <i class="mdi mdi-timer-cog-outline mdi-36px align-middle"></i>
                        </div>
                        <div class="fv-title-big border-bottom py-2 px-1" style="width: fit-content;">
                            <h6 class="text-black fw-bolder oswald-bold">Support Rapide</h6>
                        </div>
                        <div class="fv-title-normal py-2">
                            <h5 class="text-black-50">{{ about.support }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 col-sm-12 fv-w-100-sm">
                <div class="container-fluid fv-h-75-lg fv-h-100-sm fv-p-0-sm">
                    <div class="row w-100 h-100 fv-m-0-sm">
                        <div class="fv-img-fluid col col-6 p-2 fv-w-50-sm" data-aos="fade-right" v-for="img in about.gallery" :key="img.id">
                            <img :src="img.cover" :alt="img.title" :title="img.title" class="shadow img-thumbnail">
                        </div>                   
                    </div>
                </div>
                <div class="w-100 h-auto p-3">
                    <router-link to="/about" class="text-fv-secondary text-decoration-none" :class="'fvSlideOn'">
                        <i class="mdi mdi-arrow-right-thin align-middle"></i>
                        &nbsp;
                        <span class="text-uppercase">Apprendre plus sur Nous !</span>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="e" class="w-100 py-3 header-color text-white" :class="'fvSlideOn'">
    <div class="container-custom my-4 position-relative">
        <div class="text-center fv-w-50-lg fv-w-100-sm m-auto">
            <div class="fv-title-normal" :class="'fvSlideOn'">
                <h4 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;Pourquoi nous choisir ? </h4>
            </div>
            <div class="fv-title-big">
                <h3 class="fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Design the Concept of Your Business Now"></h3>
            </div>
        </div>
        <div class="w-100 mb-5 pb-3">
            <div class="container-fluid p-0">
                <div class="row fv-f-direc-col-sm">
                    <div data-aos="fade-left" class="card border-0 overflow-hidden fv-hov-light col shadow bg-primary-x fv-p-3-lg fv-m-2-lg fv-my-2-sm fv-mx-auto-sm position-relative fv-w-75-sm rounded-3" v-for="wu in whyus" :key="wu">
                        <div class="position-absolute start-0 top-0 opacity-25 p-2">
                            <div class="fv-title-big opacity-50" :class="'fvSlideOn'">
                                <h1 class="fw-bolder fa-3x oswald-bold" data-fv-anim='countdown' :data-fv-data='wu.value'></h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="fv-title-big">
                                <h6 class="fw-bolder oswald-bold"> {{ wu.name}} </h6>
                            </div>
                            <div class="fv-title-normal">
                                <h6 class="text-white-50">{{ wu.content.slice(0, 100) }} ...</h6>
                            </div>
                            <div class="py-2 x-trans-div">
                                <router-link class="text-fv-secondary text-decoration-none x-trans-link p-2 rounded-pill" :to="`/activity/${wu.id}/${wu.name}`">
                                    <i class="mdi mdi-arrow-right-thin align-middle"></i>
                                    &nbsp;
                                    <span class="text-uppercase">Apprendre Plus</span>
                                </router-link>
                            </div>
                        </div>
                        <div class="position-absolute end-0 bottom-0" data-aos="fade-right">
                            <div class="bg-opacity-25 p-2 bg-light" style="border-top-left-radius: 50%;">
                                <div class="text-white">
                                    <i :class="`mdi ${wu.icon} mdi-36px align-middle`"></i>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="fv-position-absolute-lg start-0 w-100" style="bottom: -35%;height: 133px;">
            <div class="container-fluid">
                <div class="row fv-f-direc-col-sm">
                    <div class="col shadow mx-2 position-relative fv-my-2-sm" :class="'fvSlideOn'">
                        <div class="position-absolute start-0 top-0 full rank" style="background-image: url('/img/team.jpg');" >
                            <div class="full opacity-75 bg-dark"></div>                  
                        </div>
                        <div class="text-white h-100 w-100">
                            <div class="p-3">
                                <div class="fv-slide-title">
                                    <div class="fv-slide-title-big" :class="'fvSlideOn'">
                                        <h4 class="fw-bolder oswald-bold"><span class='fw-bolder oswald-bold' data-fv-anim='countdown' data-fv-data='5'></span>ans</h4>
                                    </div>
                                    <div class="fv-slide-title-big" :class="'fvSlideOn'">
                                        <h5 class="fw-bolder oswald-bold">Annee d'Experience</h5>
                                    </div>
                                    <div class="fv-slide-title-normal" :class="'fvSlideOn'">
                                        <h6>Lorem ipsum dolor sit amet,es quia similique? Dignissimos provident quia .</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col shadow mx-2 position-relative fv-my-2-sm">
                        <div class="position-absolute start-0 top-0 full rank" style="background-image: url('/img/team.jpg');" >
                            <div class="full opacity-75 bg-dark"></div>                  
                        </div>
                        <div class="text-white h-100 w-100">
                            <div class="p-3">
                                <div class="fv-slide-title">
                                    <div class="fv-slide-title-big" :class="'fvSlideOn'">
                                        <h4 class="fw-bolder oswald-bold"><span class='fw-bolder oswald-bold' data-fv-anim='countdown' data-fv-data='8'></span>k</h4>
                                    </div>
                                    <div class="fv-slide-title-big" :class="'fvSlideOn'">
                                        <h5 class="fw-bolder oswald-bold">Clients Satisfait</h5>
                                    </div>
                                    <div class="fv-slide-title-normal" :class="'fvSlideOn'">
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
    <div class="container-custom my-5 pb-3 position-relative" :class="'fvSlideOn'">
        <div class="row row-cols-2">
            <div class="col">
                <div class="fv-title-normal" :class="'fvSlideOn'">
                    <h3 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;Nos services </h3>
                </div>
                <div class="fv-title-big" :class="'fvSlideOn'">
                    <h3 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Nous offrons plusieurs solutions dans le numerique"></h3>
                </div>
            </div>
            <div class="col text-end align-self-end" :class="'fvSlideOn'" id="allService">
                <router-link to="/services" class="btn btn-custom text-white fw-bold">TOUT NOS SERVICES</router-link>
            </div>
        </div>
        <div class="row row-cols-3 my-3 fv-f-direc-col-sm">
            <div class="col py-3 fv-px-3-lg fv-hov fv-w-100-sm fv-mx-auto-sm fv-my-2-sm" v-for="sv in services" :key="sv">
                <div class="container-fluid p-0">
                    <router-link :to="`/service/${sv.id}/${sv.name}`" class="text-decoration-none">
                        <div class="row">
                            <div class="col col-auto">
                                <img v-if="sv.logo" :src="sv.logo" :alt="sv.name" :title="sv.name" style="width:34px; max-height:40px;">
                                <i v-if="sv.icon" :class="`mdi ${sv.icon} mdi-36px text-fv-primary`"></i>
                            </div>
                            <div class="px-2 col">
                                <div class="fv-title-big">
                                    <h6 class="fw-bold oswald-bold text-dark"> {{ sv.name }} </h6>
                                </div>
                                <div class="fv-title-normal">
                                    <h6 class="text-black-50"> {{ sv.content.slice(0, 100) }} ... </h6>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="fv-position-absolute-lg start-0 w-100 fv-h-100-sm" style="bottom: -35%;height: 150px;">
            <div class="shadow p-3 position-relative full">
                <div class="position-absolute start-0 top-0 full rank" style="background-image: url('/img/team.jpg');" >
                    <div class="full opacity-75 bg-dark">
                    </div>                    
                </div>
                <div class="containter-fluid full">
                    <div class="row row-cols-2 mb-4">
                        <div class="col">
                            <div class="fv-title-normal" :class="'fvSlideOn'">
                                <h3 class="text-light m-auto"><span class="dbslash">//</span> Nous Somme Plus Qu'une stucture de coding</h3>
                            </div>
                            <div class="fv-title-big" :class="'fvSlideOn'">
                                <h4 class="text-white fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Laisser nous vous developpez vos applications"></h4>
                            </div>
                        </div>
                        <div class="col text-end align-self-end" :class="'fvSlideOn'">
                            <router-link to="/contact" class="btn btn-outline-light fw-bold">Nous Contacter</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="g" class="fv-py-5-lg bg-third">
    <div class="container-custom my-5 position-relative py-3 fv-text-center-sm">
        <div class="row row-cols-2 mt-4" :class="'fvSlideOn'">
            <div class="col fv-w-100-sm">
                <div class="fv-title-normal" :class="'fvSlideOn'">
                    <h4 class="text-uppercase text-fv-primary m-auto"><span class="dbslash">//</span> &nbsp; derniers projets realisés </h4>
                </div>
                <div class="fv-title-big" :class="'fvSlideOn'">
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
                        <div class="swiper-slide fv-w-25-lg fv-w-100-sm h-100 fv-mx-3-lg position-relative" v-for="pj in projects" :key="pj.id" data-aos="zoom-out-down">
                            <div class="card h-100 overflow-hidden" :class="'fvSlideOn'">
                                <div class="card-body p-0">
                                    <div class="fv-img-fluid w-100 h-100">
                                        <img :src="pj.cover" :alt="pj.name">
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute start-0 w-100" :class="'fvSlideOn'" style="bottom: -15%;">
                                <div class="shadow position-relative h-100 w-75 m-auto header-color overflow-hidden fv-hov-light" style="border-top-left-radius: 30%;border-bottom-right-radius: 30%">
                                    <div class="p-3">
                                        <div class="fv-title-big">
                                            <h6 class="text-white fw-bolder oswald-bold"> {{ pj.name }} </h6>
                                        </div>
                                        <div class="fv-title-normal">
                                            <h6 class="text-white-50 text-uppercase"> {{ pj.cat }} </h6>
                                        </div>
                                    </div>
                                    <div class="position-absolute end-0 top-0" :class="'fvSlideOn'">
                                        <div class="bg-opacity-25 p-2 bg-light" style="border-bottom-left-radius: 50%;">
                                            <div class="text-white">
                                                <a :href="pj.link" class="text-white text-decoration-none"><i class="mdi mdi-arrow-right-thin align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="pagin text-center mt-5 p-3"></div>
            </div>
        </div>
    </div>
</div>
<div id="h" class="w-100 text-white position-relative">
    <div class="position-absolute start-0 top-0 full rank" style="background-image: url('/img/team.jpg');" >
        <div class="full opacity-75 bg-dark"></div>                    
    </div>
    <div class="container-custom py-4 position-relative" :class="'fvSlideOn'">
        <div class="text-center fv-w-50-lg m-auto">
            <div class="fv-title-normal" :class="'fvSlideOn'">
                <h4 class="text-uppercase"><span class="dbslash">//</span> &nbsp;technology index </h4>
            </div>
            <div class="fv-title-big mb-3" :class="'fvSlideOn'">
                <h4 class="fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="We Deliver Solution With The Goal of Trusting Relationships"></h4>
            </div>
        </div>
        <div class="w-100 py-4">
            <div class="container-fluid p-2">
                <div class="row justify-content-between">
                    <button class="col btn btn-outline-light text-center m-2  fv-w-100-sm" style="width: 90px;height: 90px;" v-for="tech in techologies" :key="tech.id">
                        <div class="">
                            <i :class="`mdi ${tech.icon} mdi-24px`"></i>
                        </div>
                        <div class="fv-title-big">
                            <h6 class="fw-bolder text-uppercase oswald-bold m-auto"> {{ tech.name }} </h6>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="i" class="bg-white w-100 text-white">
    <div class="container-custom py-4 overflow-hidden position-relative">
        <div class="text-center fv-w-50-lg mx-auto my-4">
            <div class="fv-title-normal" :class="'fvSlideOn'">
                <h4 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;nos clients </h4>
            </div>
            <div class="fv-title-big mb-3" :class="'fvSlideOn'">
                <h4 class="fw-bolder oswald-bold text-dark">Nous sommes confirmer dans <span class="oswald-bold text-dark" data-fv-anim='countdown' data-fv-data="24"></span>+ Pays à travers le monde</h4>
            </div>
        </div>
        <div class="swiper swiper-y overflow-hidden my-2" style="width: 90%;margin: auto">
            <div class="swiper-wrapper">
                    <div class="swiper-slide fv-w-50-lg fv-w-100-sm h-100 mx-2 position-relative" v-for="cl in clients" :key="cl">
                        <div class="card col rounded-3 shadow bg-primary-x p-2 fv-hov-light fv-h-100-sm fv-text-center-sm" style="height:200px;">
                            <div class="card-header row border-0 fv-f-direc-col-sm">
                                <div class="text-white col col-auto">
                                    <i v-if="cl.icon" :class="`mdi ${cl.icon} mdi-24px align-middle`"></i>
                                    <img :src="cl.logo" style="width:72px;max-height:40px">
                                </div>
                                <div class="col">
                                    <div class="fv-title-big">
                                        <h6 class="fw-bolder oswald-bold">{{ cl.name }}</h6>
                                    </div>
                                    <div class="fv-title-normal">
                                        <h6 class="text-white-50"> {{ cl.title }} </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="fv-title-normal" :class="'fvSlideOn'">
                                    <h6 class="text-white-50">
                                        {{ cl.content }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div class="fv-title-normal" :class="'fvSlideOn'">
                <h4 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;notre equipe </h4>
            </div>
            <div class="fv-title-big mb-3" :class="'fvSlideOn'">
                <h4 class="fw-bolder oswald-bold text-dark">C'est plus qu'une equipe, c'est une famille de <span class="oswald-bold text-dark" data-fv-anim='countdown' data-fv-data="24"></span> travers le Pays</h4>
            </div>
        </div>
        <div class="swiper swiper-team overflow-hidden my-2" style="width: 90%;margin: auto">
            <div class="swiper-wrapper" style="">
                    <div class="swiper-slide full" v-for="tm in team" :key="tm.id" data-aos="zoom-out-down">
                        <div class="col p-3  text-center">
                            <div class="text-dark my-2">
                                <blockquote style="font-size:22px;">
                                    {{ tm.desc }}
                                </blockquote>
                            </div>
                            <div class="text-center text-dark">
                                <div class="my-2">
                                    <img :src="tm.photo" style="width:82px;height:82px" class="rounded-circle img-thumbnail">
                                </div>
                                <div class="fv-title-big">
                                    <h6 class="fw-bolder oswald-bold">{{ tm.nom }} {{ tm.prenom }}</h6>
                                </div>
                                <div class="fv-title-normal" >
                                    <h6 class="text-dark"> {{ tm.role }} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
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
<div id="f" class="fv-p-0-sm">
    <div class="container-custom my-5 position-relative">
        <div class="row row-cols-2 fv-f-direc-col-sm fv-text-center-sm">
            <div class="col fv-w-100-sm">
                <div class="fv-title-normal" :class="'fvSlideOn'">
                    <h3 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;Artcles Recemments Postés dans la section Blog </h3>
                </div>
                <div class="fv-title-big" :class="'fvSlideOn'">
                    <h3 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Nous Publions constemment Des Artciles Sur Divers Secteurs"></h3>
                </div>
            </div>
            <div class="col text-end align-self-end" :class="'fvSlideOn'" id="allService">
                <router-link to="/blog" class="btn btn-custom text-white fw-bold">TOUT LES POSTES</router-link>
            </div>
        </div>
        <div class="row row-cols-3 my-3 fv-f-direc-col-sm">
            <Blog v-for="post in blogs" :key="post.id" :current-user="{user:currentUser}" :post="post" style-custom="height:390px;" bg-style-custom="height:200px;"></Blog>
        </div>        
    </div>
</div>
<div id="j" class="mb-5">
    <div class="container-custom my-5 pb-3 position-relative">
        <div class="row row-cols-2 fv-f-direc-col-sm fv-text-center-sm">
            <div class="col fv-w-100-sm">
                <div class="fv-title-normal" :class="'fvSlideOn'">
                    <h3 class="text-uppercase text-fv-primary"><span class="dbslash">//</span> &nbsp;Question Recemments Postés dans la section Forum </h3>
                </div>
                <div class="fv-title-big" :class="'fvSlideOn'">
                    <h3 class="text-dark fw-bolder oswald-bold" data-fv-anim='autowrite' data-fv-data="Vous pouvez aussi poster"></h3>
                </div>
            </div>
            <div class="col text-end align-self-end" :class="'fvSlideOn'" id="allService">
                <router-link to="/forum" class="btn btn-custom text-white fw-bold">VOIR TOUT</router-link>
            </div>
        </div>
        <div class="row row-cols-3 my-3 fv-f-direc-col-sm">
            <Forum v-for="post in forums" :key="post.id" :current-user="{user:currentUser}" :post="post"></Forum>
        </div>        
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
           carousel: [],
           projects : [],
           services: [],
           utils: [],
           about: {content:''},
           clients: [],
           partners: [],
           techologies: [],
           team: [],
           whyus: [],
           currentSlide: 1,
           currentUser: {},
           blogs: {},
           forums: {},
        }
    },
    methods: {
        getData: function() {            
            this.$ax.get(this.$api_url + '/api/posts/').then( (e) => this.carousel = e.data.results);
            this.$ax.get(this.$api_url + '/api/projects/').then( (e) => this.projects = e.data.results);
            this.$ax.get(this.$api_url + '/api/services/').then( (e) => this.services = e.data.results.slice(0, 6));
            this.$ax.get(this.$api_url + '/api/utils/').then( (e) => this.utils = e.data.results);
            this.$ax.get(this.$api_url + '/api/clients/').then( (e) => this.clients = e.data.results);
            this.$ax.get(this.$api_url + '/api/partners/').then( (e) => this.partners = e.data.results);
            this.$ax.get(this.$api_url + '/api/whyus/').then( (e) => this.whyus = e.data.results);
            this.$ax.get(this.$api_url + '/api/tech/').then( (e) => this.techologies = e.data.results);
            this.$ax.get(this.$api_url + '/api/team/').then( (e) => this.team = e.data.results);
            this.$ax.get(this.$api_url + '/api/about/').then( (e) => {
                this.about = e.data.results[0];
            });
            this.$ax.get(`${this.$api_url}/api/user-auth/`, this.$UserOptionsRefresh()).then( (e) => {
                this.currentUser = e.data.results[0] ?? false;
            }).catch(error => {
                if(error.response.status === 401){
                    window.sessionStorage.removeItem(this.$authSessionName);
                }
            });
            this.$ax.get(this.$api_url + '/api/blog/').then( (e) => {
                this.blogs = e.data.results.slice(0, 3);
            });
            this.$ax.get(this.$api_url + '/api/forum/').then( (e) => {
                this.forums = e.data.results.slice(0, 3);
            });
        }
    },
    mounted() {
        this.getData();          
        new Swiper('.swiper-partner', {
                direction: 'horizontal',
                loop: false,
                pagination: {
                    el: '.pagin',
                    clickable: true,
                },
            })
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
          new fJs.AutoWriteText({
            separator: '|',
            timeout: 300
        });
    },
    updated() {
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
                this.currentSlide = ev.item.index - 1;
            });

            $('.fv-carousel-control-prev').click(function(){
                $('.home-slide .owl-prev').click();
            });
            $('.fv-carousel-control-next').click(function(){
                $('.home-slide .owl-next').click();
            });
        new fJs.Intersection({
            elt: '.fvSlideOn',
            class: "animate__animated animate__fadeInDown opacity-100",
            root: null,
            ratio: 0.2,
            rootMargin: '0px',
            threshold: 0.7,
        });
        new fJs.NumberAutoCount();
    },
            
}
</script>