<script setup>
import SearchBar from "@/components/SearchBar.vue";
import Forum from "../components/Forum.vue";

</script>
<template>
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="fv-title-normal fvSlideOn my-3">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Forum / Categorie / <i :class="`mdi ${category.results[0].icon ? '' : ''} align-middle`"></i> {{ $route.params.title }}</h3>
            </div>      
            <SearchBar model="forum"></SearchBar>
            <div class="my-3 container-fluid">
                <div class="fv-title-big fvSlideOn">
                    <h2 class="text-dark fw-bolder">Publications de {{ $route.params.title }} </h2>
                </div>
                <div class="row fv-f-direc-col-sm">
                    <Forum v-for="post in category.results[0].forums" :key="post.id" :current-user="{user:currentUser}" :post="post"></Forum>
                </div>
                <div class="my-3 text-center w-100" v-if="category.count >= 9">
                    <ul class="pagination w-50 mx-auto">
                        <li class="page-item previous" :class="!category.previous ? 'disabled' : null" @click="category.previous ? paginateTo(category.previous, --page): null">
                            <a href="javascript:void(0)" class="page-link">Precedent</a>
                        </li>
                        <li class="page-item" v-for="u in Math.ceil(category.count / 9)" :key="u" @click="paginate(u)" :class="u === page ? 'active' : 'inactive'">
                            <a href="javascript:void(0)" class="page-link"> {{ u }} </a>
                        </li>
                        <li class="page-item next" :class="!category.next ? 'disabled' : null" @click="category.next ? paginateTo(category.next, ++page): null">
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
            category: {results: [{}]},
            page: 1,
            currentUser: false,
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
            this.$ax.get(this.$api_url + '/api/category/?name=' + this.$route.params.title).then( (e) => {
                if(e.data.results.length > 0) {
                    this.category = e.data;
                }             
            });
        },
        paginate: function(page) {
            this.paginateTo(this.$api_url + '/api/category/?page=' + page, page);
        },
        paginateTo: function(url, page) {
            this.$Progress.start();
            this.$ax.get(url).then( (e) => {
                this.category = e.data;
                this.page = page;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
            })
        }
    },
    mounted() {
         this.getPost();         
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
}
</script>