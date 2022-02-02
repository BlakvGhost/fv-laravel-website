<script setup>
   import ContactUs from "../components/ContactUs.vue";
</script>
<template>
    <div class="border-top p-3">
        <article class="container-custom my-3">
            <div class="text-end fv-title-normal" style="font-size:18px;">
               <!-- Publié {{ new Date(post.pub_date).toLocaleString() }} -->
            </div>
            <blockquote>
                <div class="fv-title-normal fvSlideOn">
                        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp;  NOS SERVICES </h3>
                    </div>
                    <div class="fv-title-big">
                        <h3 class="text-dark fw-bolder oswald-bold">
                            <img v-if="service.logo" :src="service.logo" :alt="service.name" :title="service.name" style="width:55px; max-height:40px;">
                            <i v-if="service.icon" :class="`mdi ${service.icon} mdi-36px text-fv-primary`"></i>
                            | {{ service.name }}
                        </h3>
                </div>
                <div class="fv-title-normal fvSlideOn">
                    <blockquote class="text-black-50 fv-p-2-lg fv-py-4-sm">
                        <div style="font-size:22px">
                            {{ service.content }}
                        </div>
                    </blockquote>
                </div>
            </blockquote>
            <div class="my-3 border-top">
                <div class="p-2" style="font-size:22px">
                    <p>Partager: </p>
                    <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-facebook"></i></a>
                    <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-twitter"></i></a>
                    <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-whatsapp"></i></a>
                    <a href="javascript:void(0)" class="text-decoration-none"><i class="mdi mdi-linkedin"></i></a>
                </div>
            </div>
            <ContactUs></ContactUs>
        </article>
    </div>
</template>

<script>
export default {
    data() {
        return {
            service: {},
        }
    },
    methods: {
        getData: function() {
            try {
                this.$ax.get(`${this.$api_url}/api/services/${this.$route.params.id}/`, this.$httpOptions).then( (e) => {
                    this.service = e.data;
                });                
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getData();
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