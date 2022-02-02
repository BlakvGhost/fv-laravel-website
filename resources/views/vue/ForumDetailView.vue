<script setup>
    import Comment from "@/components/Comment.vue";
    import SearchBar from "@/components/SearchBar.vue";
    import Forum from "@/components/Forum.vue";

</script>
<template>
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="fv-title-normal fvSlideOn my-3">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Forum / {{ post.category }} </h3>
            </div>      
            <SearchBar model="forum"></SearchBar>
            <article class=" my-3">
                <div class="text-end fv-title-normal" style="font-size:18px;">
                Publié {{ new Date(post.pub_date).toLocaleString() }} | <strong>{{ post.user.first_name + ' ' + post.user.last_name }}</strong>
                </div>
                <blockquote>
                    <div class="fv-title-normal fvSlideOn">
                        <blockquote class="text-black-50 p-2">
                            <h4 class="text-dark fw-bolder oswald-bold">
                                {{ post.title }}
                            </h4>                           
                        </blockquote>
                    </div>
                </blockquote>
                <Comment post-type="forum" :post="post"></Comment>
                <div class="my-3 container-fluid">
                <div class="fv-title-big fvSlideOn">
                    <h2 class="text-dark fw-bolder">Publications Similaires</h2>
                </div>
                <div class="row">
                    <Forum v-for="post in similarPostFiltered" :key="post.id" :current-user="currentUser" :post="post"></Forum>
                </div>                
            </div>
            </article>       
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            post: {user: {}},
            similarPosts: [],
            currentUser: false,
        };
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
            this.$ax.get(this.$api_url + '/api/forum/' + this.$route.params.id + '/').then( (e) => {
                this.post = e.data;
            });
            this.$ax.get(this.$api_url + '/api/category/?name=' + this.$route.params.category).then( (e) => {
                this.similarPosts = e.data.results[0].forums;
            });
        },
    },
    created() {
        this.getPost();     
    },
    updated() {
        new fJs.Intersection({
            elt: ".fvSlideOn",
            class: "animate__animated animate__fadeInDown opacity-100",
            root: null,
            ratio: 0.2,
            rootMargin: "0px",
            threshold: 0.7,
        });
    },
    computed: {
        similarPostFiltered: function() {
           return this.similarPosts.filter( e => e.id != this.post.id)
        }
    }
}
</script>