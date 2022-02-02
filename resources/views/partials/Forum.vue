<script setup>
    defineProps({
        post: Object,
        currentUser: Object || Boolean,
        styleCustom: String,
        bgStyleCustom: String,
    })
</script>
<template>
    <article class="col col-4 p-2 fv-w-100-sm" :style="styleCustom">
        <div class="full border p-2 rounded overflow-hidden">
            <div class="">
                <div class="text-dark fvSlideOn">
                    <router-link :to="`/forum/${post.id}/${post.category}/${post.title}`" class="text-decoration-none text-dark">
                        <h4> {{ post.title.slice(0, 40) }} </h4>
                    </router-link>
                </div>
                <div class="my-2 fvSlideOn" style="font-size:22px">
                    <router-link :to="`/forum/category/${post.category}`" class="btn btn-warning text-uppercase">{{post.category}}</router-link>
                    <span class="text-dark ps-1 text-decoration-underline">{{ new Date(post.pub_date).toLocaleString() }}</span>
                </div>                
            </div>
            <div class="mt-2">
                <a href="javascript:void(0)" class="btn btn-light" @click=" user ? ChecklikePost(!is_liker, true): null" :class="is_liker ? 'text-danger': null">
                    <i class="mdi" :class="is_liker ? 'mdi-thumb-up': 'mdi-thumb-up-outline'"></i>
                    <span> {{ likes.count }} </span>
                </a>
                <a href="javascript:void(0)" class="btn btn-light" @click="user ? ChecklikePost(!is_unliker, false): false" :class="is_unliker ? 'text-danger': null">
                    <i class="mdi" :class="is_unliker ? 'mdi-thumb-down': 'mdi-thumb-down-outline'"></i>
                    <span> {{ unlikes.count }} </span>
                </a>
                <router-link :to="`/forum/${post.id}/${post.category}/${post.title}#postComment`" class="btn btn-light" :class="is_commented ? 'text-danger': null">
                    <i class="mdi mdi-android-messages"></i>
                    <span> {{ comments.count }} </span>
                </router-link>
                <a href="javascript:void(0)" class="btn btn-light disabled" :class="is_viewed ? 'text-danger': null">
                    <i class="mdi mdi-eye-outline"></i>
                    <span> {{ lesVues.count }} </span>
                </a>
            </div>
        </div>
    </article>
</template>

<script>
export default {
    data() {
        return {
            comments: {results: []},
            likes: {results: []},
            unlikes: {results: []},
            lesVues: {results: []},
            user: {},
        }
    },
    methods: {
        getReactions: function() {
            this.$ax.get(`${this.$api_url}/api/comments/?post_type=forum&post_id=${this.post.id}`).then( (e) => {
                this.comments = e.data;
            });
            this.$ax.get(`${this.$api_url}/api/likes/?post_type=forum&post_id=${this.post.id}&is_liked=true&is_like=true`).then( (e) => {
                this.likes = e.data;
            });
            this.$ax.get(`${this.$api_url}/api/likes/?post_type=forum&post_id=${this.post.id}&is_liked=true&is_like=false`).then( (e) => {
                this.unlikes = e.data;
            });
            this.$ax.get(`${this.$api_url}/api/les-vues/?post_type=forum&post_id=${this.post.id}`).then( (e) => {
                this.lesVues = e.data;
            });
        },
        ChecklikePost: function(is_liker, is_like) {
           this.likePost(is_liker, is_like)
        },
        likePost: function(is_liker, is_like) {
            const data = {
                post_type: 'forum',
                post_id: this.post.id,
                is_liked: is_liker,
                is_like: is_like,
            }
            if (!data.is_liked) {
                this.$ax.get(`${this.$api_url}/api/likes/?post_type=forum&post_id=${data.post_id}&is_liked=true&user=${this.user.id}&is_like=${data.is_like}`, this.$UserOptions).then( (e) => {
                    if(e.data.results[0].id) {
                        this.$ax.patch(`${this.$api_url}/api/likes/${e.data.results[0].id}/`, data, this.$UserOptions).then( (e) => {
                            this.getReactions();
                        })
                    }
                })                
            }else{
                this.$ax.post(this.$api_url + '/api/likes/', data, this.$UserOptions).then( (e) => {
                    this.getReactions();
                })
            }   
        },
    },
    created() {
        this.user = this.currentUser['user']
        this.getReactions();
    },
    computed: {
        is_liker: function() {
           try {
               return this.likes.results.filter( l => l.user.username == this.user.username).length
           } catch (error) {
               return false
           }
        },
        is_unliker: function() {
           try {
               return this.unlikes.results.filter( l => l.user.username == this.user.username).length
           } catch (error) {
               return false
           }
        },
        is_viewed: function() {
           try {
               return this.lesVues.results.filter( l => l.user.username == this.user.username).length
           } catch (error) {
               return false
           }
        },
        is_commented: function() {
           try {
               return this.comments.results.filter( l => l.user.username == this.user.username).length
           } catch (error) {
               return false
           }
        },
    }
}
</script>