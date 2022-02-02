<script setup>
    import Comment from "@/components/Comment.vue";
    import SearchBar from "@/components/SearchBar.vue";
    import Blog from "@/components/Blog.vue";

</script>
<template>
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="fv-title-normal fvSlideOn my-3">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Blog / {{ post.title }} </h3>
            </div>     
            <SearchBar model="blog"></SearchBar>
            <article class=" my-3">
                <div class="text-end fv-title-normal" style="font-size:22px;">
                Publié {{ new Date(post.pub_date).toLocaleString() }} | <strong>{{ post.user.first_name + ' ' + post.user.last_name }}</strong>
                </div>
                <blockquote>
                    <div class="fv-title-big fvSlideOn">
                        <h3 class="text-dark fw-bolder oswald-bold">
                            {{ post.title }}
                        </h3>
                    </div>
                    <div class="fv-title-normal fvSlideOn">
                        <blockquote class="text-black-50 fv-p-2-lg fv-py-4-sm">
                            <div style="height:400px; width:100%;" class="my-3 w300">
                                <img :src="post.cover" :alt="post.title" style="height:100%; width:100%;">
                            </div>
                            <div style="font-size:22px">
                                {{ post.content }}
                            </div>                            
                        </blockquote>
                    </div>
                </blockquote>
                <Comment post-type="blog" :post="post"></Comment>
                <div class="my-3 container-fluid">
                <div class="fv-title-big fvSlideOn">
                    <h2 class="text-dark fw-bolder">Publications Similaires</h2>
                </div>
                <div class="row fv-f-direc-col-sm">
                    <Blog v-for="post in similarPostFiltered" :key="post.id" :current-user="{user:currentUser}" :post="post" style-custom="height:290px;" bg-style-custom="height:100px;"></Blog>
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
            this.$ax.get(this.$api_url + '/api/blog/' + this.$route.params.id + '/').then( (e) => {
                this.post = e.data;
            });
            this.$ax.get(this.$api_url + '/api/category/?name=' + this.$route.params.category).then( (e) => {
                this.similarPosts = e.data.results[0].blogs;
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