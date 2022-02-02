<script setup>
    import SearchBar from "@/components/SearchBar.vue";
    import Blog from "@/components/Blog.vue";
import router from "../router";

</script>
<template>
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="fv-title-normal fvSlideOn my-3">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Blog</h3>
            </div>      
            <SearchBar model="blog"></SearchBar>
            <div class="my-3 container-fluid overflow-hidden">
                <div class="fv-title-big fvSlideOn">
                    <h2 class="text-dark fw-bolder">Filtrer Par Categorie</h2>
                </div>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide fv-w-50-sm" style="width:20%" v-for="cat in category" :key="cat">
                            <div class="p-4">
                                <router-link style="height:90px;width:120px;" :to="`/blog/category/${cat.name}`" class="btn btn-success text-decoration-none" :title="cat.description">
                                    <h4 class="m-0">
                                        <i :class="`mdi ${cat.icon} align-middle`"></i><br>
                                        {{cat.name}}
                                    </h4>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="pagin text-center p-2 text-dark"></div>
                </div>
            </div>
            <div class="my-3 container-fluid fv-p-0-sm">
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
            </div>            
            <div class="my-3 container-fluid fv-p-0-sm">
                <div class="fv-title-big fvSlideOn">
                    <h2 class="text-dark fw-bolder">Publications Recentes</h2>
                </div>
                <div class="row fv-f-direc-col-sm fv-m-0-sm">
                    <Blog v-for="post in recentPost.results" :key="post.id" :current-user="{user:currentUser}" :post="post" style-custom="height:390px;" bg-style-custom="height:200px;"></Blog>
                </div>
                <div class="my-3 text-center w-100" v-if="recentPost.count >= 9">
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
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            currentUser: false,
            category: [],
            recentPost: [],
            popularPost: [],
            page: 1,
        }
    },
    methods: {
        getPost: function() {
            this.$ax.get(`${this.$api_url}/api/user-auth/`, this.$UserOptionsRefresh()).then( (e) => {
                this.currentUser = e.data.results[0] ?? false;
            }).catch(error => {
                if(error.response.status === 401){
                    window.sessionStorage.removeItem(this.$authSessionName);
                }
            });
            this.$ax.get(this.$api_url + '/api/category/').then( (e) => {
                this.category = e.data.results;
            });
            this.$ax.get(this.$api_url + '/api/blog/').then( (e) => {
                this.recentPost = e.data;
            });
            this.$ax.get(this.$api_url + '/api/popularBlog/').then( (e) => {
                this.popularPost = e.data.results;
            });
        },
        paginate: function(page) {
            this.paginateTo(this.$api_url + '/api/blog/?page=' + page, page);
        },
        paginateTo: function(url, page) {
            this.$Progress.start();
            this.$ax.get(url).then( (e) => {
                this.recentPost = e.data;
                this.page = page;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
            })
        }
    },
    mounted() {
         this.getPost();
         new Swiper('.swiper', {
                direction: 'horizontal',
                loop: true,
                pagination: {
                    el: '.pagin',
                    clickable: true,
                },
            })
    },
    updated() {
       
        new fJs.Intersection({
            elt: '.fvSlideOn',
            class: "animate__animated animate__fadeInDown opacity-100",
            root: null,
            ratio: 0.2,
            rootMargin: '0px',
            threshold: 0.7,
        });
        
    },
    watch() {
        rout
    }
}
</script>