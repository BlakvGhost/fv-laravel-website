<script setup>
    defineProps({
        postType :{
            type: String,
            required: true,
        },
        post :{
            type: Object,
            required: true,
        },
    })
</script>
<template>
    <div class="my-3 border-top" style="font-size:22px">
        <div class="fv-title-normal fvSlideOn my-3">
            <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Reaction au Poste </h3>
        </div>
        <div class="my-2">
            <a href="javascript:void(0)" class="btn btn-light" @click="ChecklikePost(!is_liker, true)" :class="is_liker ? 'text-danger': null">
                <i class="mdi" :class="is_liker ? 'mdi-thumb-up': 'mdi-thumb-up-outline'"></i>
                <span> {{ likes.count }} </span>
            </a>
            <a href="javascript:void(0)" class="btn btn-light" @click="ChecklikePost(!is_unliker, false)" :class="is_unliker ? 'text-danger': null">
                <i class="mdi" :class="is_unliker ? 'mdi-thumb-down': 'mdi-thumb-down-outline'"></i>
                <span> {{ unlikes.count }} </span>
            </a>
            <a href="#postComment" class="btn btn-light disabled" :class="is_commented ? 'text-danger': null">
                <i class="mdi mdi-android-messages"></i>
                <span> {{ comments.count }} </span>
            </a>
            <a href="javascript:void(0)" class="btn btn-light disabled" :class="is_viewed ? 'text-danger': null">
                <i class="mdi mdi-eye-outline"></i>
                <span> {{ lesVues.count }} </span>
            </a>
        </div>
        <div class="my-3">
            <form method="POST" class="py-2" v-if="currentUser" @submit.prevent="form" id="postComment">
                <div class="alert alert-dismissible alert-danger" role="alert" id="liveAlert" v-if="(error || customError) && !success">
                    <div class="msg-alert">
                        {{ customError }}
                        <p v-for=" (er, val) in error" :key="er">
                            <strong> {{val}} </strong> 
                                =>
                            <small v-for="e in er" :key="e">{{ e }}</small>
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="alert alert-dismissible alert-success" role="alert" id="liveAlertSuccess" v-if="success">
                    <div class="msg-alert text-center">
                        <h3>Vous-Avez bien commenter !</h3>                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="form-text">Commentaire* : </label>
                    <textarea name="message" id="message" placeholder="Entrer votre Message" class="form-control" cols="40" rows="5" v-model="content"></textarea>
                </div>
                <div class="text-center my-2">
                    <button type="submit" class="btn btn-success w-50 m-auto">ENVOYER</button>
                </div>
            </form>
            <div class="alert alert-dismissible alert-warning" role="alert" id="liveAlertWarn" v-if="!currentUser">
                <div class="msg-alert text-center">
                    <h3> Connectez-Vous avant d'effectuer des commentaires sur cette Publication</h3>
                    <router-link style="font-size:22px" to="/membres/connecter" class="btn btn-link">Connexion</router-link>
                    <router-link style="font-size:22px" to="/membres/inscription" class="btn btn-link">Creation de Compte</router-link>
                </div>
            </div>
        </div>
        <div class="my-2">
            <div v-for="comment in comments.results" :key="comment.id">
                <div class="card m-2 p-2 fvSlideOn">
                    <div class="card-header bg-transparent row border-0">
                        <div class="text-white col col-auto">
                            <img :src="comment.user.cover ?? '/logo.jpg' " class="rounded-circle img-trumbnail" style="width:72px;height:72px;">
                        </div>
                        <div class="col text-dark align-self-center">
                            <div class="fv-title-big">
                                <h6 class="fw-bolder oswald-bold"> {{ comment.user.first_name + ' ' + comment.user.last_name }} </h6>
                            </div>
                            <div class="fv-title-normal">
                                <h6 class="text-fv-primary"> {{new Date(comment.pub_date).toLocaleString()}} </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fv-title-normal fvSlideOn">
                            <h6 class="text-dark"  style="font-size:22px">
                                {{ comment.content }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 text-center w-100" v-if="comments.count >= 5">
                <ul class="pagination w-50 mx-auto">
                    <li class="page-item previous" :class="!comments.previous ? 'disabled' : null" @click="comments.previous ? paginateTo(comments.previous, --page): null">
                        <a href="javascript:void(0)" class="page-link">Precedent</a>
                    </li>
                    <li class="page-item" v-for="u in Math.ceil(comments.count / 5)" :key="u" @click="paginate(u)" :class="u === page ? 'active' : 'inactive'">
                        <a href="javascript:void(0)" class="page-link"> {{ u }} </a>
                    </li>
                    <li class="page-item next" :class="!comments.next ? 'disabled' : null" @click="comments.next ? paginateTo(comments.next, ++page): null">
                        <a href="javascript:void(0)" class="page-link">Suivant</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            error: null,
            success: false,
            customError: null,          
            content: null,
            comments: {results: []},
            currentUser: false,
            page: 1,
            likes: {results: []},
            unlikes: {results: []},
            lesVues: {results: []},
            is_viewed: false
        }
    },
    methods: {
        insert: function(data) {
            this.$Progress.start();
            this.$ax.post(this.$api_url + '/api/comments/',data, this.$UserOptionsRefresh()).then( (response) => {
                if (response.data) {
                    this.success = true;
                    this.getReactions();
                    this.content = null,
                    this.$toastr("Commentaire", this.$successMessage, "success");
                    this.$Progress.finish();
                }else{
                    this.customError = this.$BadFieldsErrorMessage;
                    this.$toastr("Commmentaire", this.$BadFieldsErrorMessage, "error");
                    this.$Progress.fail();
                }
            }).catch((error) => {
                this.$Progress.fail();
                this.error = error.response.data;
                this.$toastr("Commmentaire", this.$BadFieldsErrorMessage, "error");
            })
        },
        ChecklikePost: function(is_liker, is_like) {
            this.currentUser ? this.likePost(is_liker, is_like): this.$toastr("Blog", this.$likeError, "error");
           
        },
        likePost: function(is_liker, is_like) {
            const data = {
                post_type: this.postType,
                post_id: this.$route.params.id,
                is_liked: is_liker,
                is_like: is_like,
            }
            if (!data.is_liked) {
                this.$ax.get(`${this.$api_url}/api/likes/?post_type=${this.postType}&post_id=${this.$route.params.id}&is_liked=true&user=${this.currentUser[0].id}&is_like=${data.is_like}`, this.$UserOptions).then( (e) => {
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
        getReactions: function() {
            this.$ax.get(`${this.$api_url}/api/comments/?post_type=${this.postType}&post_id=${this.$route.params.id}`).then( (e) => {
                this.comments = e.data;
            });
            this.$ax.get(`${this.$api_url}/api/likes/?post_type=${this.postType}&post_id=${this.$route.params.id}&is_liked=true&is_like=true`).then( (e) => {
                this.likes = e.data;
            });
            this.$ax.get(`${this.$api_url}/api/likes/?post_type=${this.postType}&post_id=${this.$route.params.id}&is_liked=true&is_like=false`).then( (e) => {
                this.unlikes = e.data;
            });
            this.$ax.get(`${this.$api_url}/api/les-vues/?post_type=${this.postType}&post_id=${this.$route.params.id}`).then( (e) => {
                this.lesVues = e.data;
            });
        },
        getData: function() {
            this.getReactions();
            this.$ax.get(`${this.$api_url}/api/user-auth/`, this.$UserOptionsRefresh()).then( (e) => {
                this.currentUser = e.data.results ?? false;
            }).catch(error => {
                if(error.response.status === 401){
                    window.sessionStorage.removeItem(this.$authSessionName);
                }
            });
        },
        setView: function() {
            const data = {
                post_type: this.postType,
                post_id: this.$route.params.id,
            }
            this.$ax.post(this.$api_url + '/api/les-vues/', data, this.$UserOptionsRefresh()).then( (e) => {
                this.is_viewed = e.status == 201 ? true: false
            })
        },
        form: function() {
            const data = {
                post_id: this.$route.params.id,
                post_type: this.postType,
                content: this.content,
            }
            if (data.content && data.post_id && data.post_type){
                this.insert(data);
            }else{
                this.success = null;
                this.customError = this.$emptyFieldsErrorMessage;
                this.$toastr("Commmentaire", this.$emptyFieldsErrorMessage, "error");
            }
        },
        paginate: function(page) {
            this.paginateTo(this.$api_url + '/api/comments/?page=' + page, page);
        },
        paginateTo: function(url, page) {
            this.$Progress.start();
            this.$ax.get(url).then( (e) => {
                this.comments = e.data;
                this.page = page;
                this.$Progress.finish();
            }).catch(error => {
                this.$Progress.fail();
            })
        }
    },    
    mounted() {
        this.$UserOptionsRefresh();
        this.setView();
        this.getData();
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
    computed: {
        is_liker: function() {
           try {
               return this.likes.results.filter( l => l.user.username == this.currentUser[0].username).length
           } catch (error) {
               return false
           }
        },
        is_unliker: function() {
           try {
               return this.unlikes.results.filter( l => l.user.username == this.currentUser[0].username).length
           } catch (error) {
               return false
           }
        },
        is_commented: function() {
           try {
               return this.comments.results.filter( l => l.user.username == this.currentUser[0].username).length
           } catch (error) {
               return false
           }
        },
    }
}
</script>
