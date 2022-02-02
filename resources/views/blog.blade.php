@extends('base.base')
@section('title')
    Blog({{ $posts->count() }})
@endsection

@section('main')
<div class="border-top p-3">
    <div class="container-custom my-3">
        <div class="fv-title-normal fvSlideOn my-3">
            <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Blog</h3>
        </div>      
        <x-search></x-search>
        <div class="my-3 container-fluid overflow-hidden">
            <div class="fv-title-big fvSlideOn">
                <h2 class="text-dark fw-bolder">Filtrer Par Categorie</h2>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($categories as $cat)
                        <div class="swiper-slide fv-w-50-sm fv-w-25-lg" style="width:20%">
                            <div class="p-4">
                                <a style="height:90px;width:120px;" href="`/blog/category/${cat.name}`" class="btn btn-success text-decoration-none" title="{{ $cat->desc }}">
                                    <h4 class="m-0">
                                        <i class="mdi {{ $cat->icon }} align-middle"></i><br>
                                        {{ $cat->name }}
                                    </h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagin text-center p-2 text-dark"></div>
            </div>
        </div>
        {{-- <div class="my-3 container-fluid fv-p-0-sm">
            <div class="fv-title-big fvSlideOn">
                <h2 class="text-dark fw-bolder">Publications Populaires</h2>
            </div>
            <div class="row row-cols-2 justify-content-between fv-f-direc-col-sm fv-m-0-sm">
                <article class="col col-6 fv-w-100-sm fv-my-2-sm fv-p-0-sm" style="height:200px;" v-for="post in popularPost" :key="post.id">
                    <div class="position-relative full shadow rounded overflow-hidden">
                        <div class="position-absolute start-0 top-0 full rank" :style="`background-image: url('${post.cover}');`" >
                            <div class="full opacity-75 bg-dark"></div>           
                        </div>
                        <div class="position-absolute start-0 bottom-0 fv-px-3-lg fv-p-0-sm">
                            <div class="my-2 fvSlideOn" style="font-size:22px">
                                <router-link :to="`/blog/category/${post.category}`" class="btn btn-warning text-uppercase mx-3">{{post.category}}</router-link>
                                <span class="text-white text-decoration-underline"> {{ new Date(post.pub_date).toLocaleString() }} </span>
                            </div>
                            <div class="text-light fvSlideOn">
                                <router-link :to="`/blog/${post.id}/${post.category}/${post.title}`" class="text-decoration-none text-light">
                                    <h4> {{ post.title.slice(0, 40) }} </h4>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>             --}}
        <div class="my-3 container-fluid fv-p-0-sm">
            <div class="fv-title-big fvSlideOn">
                <h2 class="text-dark fw-bolder">Publications Recentes</h2>
            </div>
            <div class="row fv-f-direc-col-sm fv-m-0-sm">
                @foreach($posts as $post)
                    <x-blog-unique :post="$post" style-custom="height:390px;" bg-style-custom="height:200px;"></x-blog-unique>
                @endforeach
            </div>
            {{-- <div class="my-3 text-center w-100" v-if="recentPost.count >= 9">
                <ul class="pagination w-50 mx-auto">
                    <li class="page-item previous" :class="!recentPost.previous ? 'disabled' : null" @click="recentPost.previous ? paginateTo(recentPost.previous, --page): null">
                        <a href="javascript:void(0)" class="page-link">Precedent</a>
                    </li>
                    <li class="page-item" v-for="u in Math.ceil(recentPost.count / 9)" :key="u" @click="paginate(u)" :class="u === page ? 'active' : 'inactive'">
                        <a href="javascript:void(0)" class="page-link"> {{ u }} </a>
                    </li>
                    <li class="page-item next" :class="!recentPost.next ? 'disabled' : null" @click="recentPost.next ? paginateTo(recentPost.next, ++page): null">
                        <a href="javascript:void(0)" class="page-link">Suivant</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        new Swiper('.swiper', {
                direction: 'horizontal',
                loop: true,
                pagination: {
                    el: '.pagin',
                    clickable: true,
                },
            })
    </script>
@endsection