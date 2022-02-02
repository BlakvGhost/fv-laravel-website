<script setup>
   import ContactUs from "../components/ContactUs.vue";
</script>
<template>
    <div class="border-top p-3">
        <article class="container-custom my-3" style="font-size:22px">
            <div class="text-end fv-title-normal" style="font-size:22px;">
               
            </div>
            <blockquote>
                    <div class="fv-title-normal fvSlideOn">
                        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp; En Savoir Plus Sur Nous </h3>
                    </div>
                    <div class="fv-title-big">
                        <h3 class="text-dark fw-bolder oswald-bold">
                            {{ about.title }}
                        </h3>
                    </div>
                    <div class="fv-title-normal">
                        <div class="text-black-50 p-2">
                            <div style="font-size:22px">
                                {{ about.content }}
                            </div>
                            <div class="row row-cols-lg-2 row-cols-sm-1" style="font-size:22px">
                                <div class="col col-lg-6 col-sm-12">
                                    <div class="text-fv-primary">
                                        <i class="mdi mdi-certificate-outline mdi-36px align-middle"></i>
                                    </div>
                                    <div class="fv-title-big border-bottom py-2 px-1" style="width: fit-content;">
                                        <h6 class="text-black fw-bolder oswald-bold">Experience</h6>
                                    </div>
                                    <div class="fv-title-normal py-2 fvSlideOn">
                                        <h5 class="text-black-50">{{ about.experience }} </h5>
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
                                        <h5 class="text-black-50">{{ about.support }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid h-75 fv-p-0-sm">
                                <div class="row w-100 h-100 fv-f-direc-col-sm fv-m-0-sm">
                                    <div class="fv-img-fluid col col-6 p-2 fv-w-100-sm" v-for="img in about.gallery" :key="img.id">
                                        <img :src="img.cover" :alt="img.title" :title="img.title" class="shadow img-thumbnail">
                                    </div>                   
                                </div>
                            </div>
                        </div>
                    </div>
            </blockquote>
            <ContactUs></ContactUs>
        </article>
    </div>
</template>

<script>
export default {
    data() {
        return {
            about: {},
        };
    },
    methods: {
        getData: function () {
            try {
                this.$ax.get(this.$api_url + "/api/about/", this.$httpOptions).then((e) => {
                    this.about = e.data.results[0];
                });
            }
            catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getData();
            new fJs.Intersection({
                elt: '.fvSlideOn',
                class: "animated fadeInUp opacity-100",
                root: null,
                ratio: 0.2,
                rootMargin: '0px',
                threshold: 0.7,
            });
    },
}
</script>