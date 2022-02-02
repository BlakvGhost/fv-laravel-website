<script setup>
    import SearchBar from "../components/SearchBar.vue";
    import Forum from "../components/Forum.vue";

</script>
<template>
    <div class="border-top p-3">
        <div class="container-custom my-3">
            <div class="fv-title-normal fvSlideOn my-3">
                <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; Forum</h3>
            </div>      
            <SearchBar model="forum"></SearchBar>      
            <div class="my-3" style="font-size:22px">
                <div class="pt-2">
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
                            <h3>Vous-Avez bien Forumer :D !</h3>                        
                        </div>
                    </div>
                    <div class="alert alert-dismissible alert-warning" role="alert" id="liveAlertWarn" v-if="!currentUser">
                        <div class="msg-alert text-center">
                            <h3> Connectez-Vous avant d'effectuer de Poser des question dans le forum</h3>
                            <router-link style="font-size:22px" to="/membres/connecter" class="btn btn-link">Connexion</router-link>
                            <router-link style="font-size:22px" to="/membres/inscription" class="btn btn-link">Creation de Compte</router-link>
                        </div>
                    </div>
                </div>
                <form method="POST" class="py-2" style="font-size:22px" v-if="currentUser" @submit.prevent="form">
                    <div class="form-group">
                        <label for="categorie" class="form-text">Selectionner une catgerie * : </label>
                        <select class="form-select" v-model="categorie" id="categorie">
                            <option v-for="cat in category" :key="cat" :value="cat.name"> {{ cat.name }} </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-text">Poser votre question par ici : </label>
                        <textarea name="message" id="message" placeholder="Entrer votre Question" class="form-control" cols="40" rows="5" v-model="message"></textarea>
                    </div>
                    <div class="text-center my-2">
                        <button type="submit" class="btn btn-success w-50 m-auto">ENVOYER</button>
                    </div>
                </form>
            </div>
            <div class="my-3 container-fluid overflow-hidden fv-p-0-sm">
                <div class="fv-title-big fvSlideOn">
                    <h2 class="text-dark fw-bolder">Filtrer Par Categorie</h2>
                </div>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide fv-w-50-sm" style="width:20%" v-for="cat in category" :key="cat">
                            <div class="p-4">
                                <router-link style="height:90px;width:120px;" :to="`/forum/category/${cat.name}`" class="btn btn-success text-decoration-none" :title="cat.description">
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
                    <h2 class="text-dark fw-bolder">Les Recentes</h2>
                </div>
                <div class="row fv-f-direc-col-sm fv-m-0-sm">
                    <Forum v-for="post in recentPost" :key="post.id" :current-user="{user:currentUser}" :post="post"></Forum>
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
            recentPost: {},
            page: 1,
            categorie:null,
            message: null,
            success: false,
            customError: null,
            error: null,
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
            this.$ax.get(this.$api_url + '/api/forum/').then( (e) => {
                this.recentPost = e.data.results;
            });
        },
        paginate: function(page) {
            this.paginateTo(this.$api_url + '/api/forum/?page=' + page, page);
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
        },
        insert: function(data) {
            this.$Progress.start();
            this.$ax.post(this.$api_url + '/api/forum/',data, this.$UserOptionsRefresh()).then( (response) => {
                if (response.data) {
                    this.success = true;
                    this.getPost();
                    this.message = null,
                    this.$toastr("Forum", this.$successMessage, "success");
                    this.$Progress.finish();
                }else{
                    this.customError = this.$BadFieldsErrorMessage;
                    this.$toastr("Forum", this.$BadFieldsErrorMessage, "error");
                    this.$Progress.fail();
                }
            }).catch((error) => {
                this.$Progress.fail();
                this.error = error.response.data;
            })
        },
        form: function() {
            const data = {
                title: this.message,
                category: this.categorie,
            }
            if (data.title && data.category){
                this.insert(data);
            }else{
                this.customError = this.$emptyFieldsErrorMessage;
                this.$toastr("Forum", this.$emptyFieldsErrorMessage, "error");
            }
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
}
</script>