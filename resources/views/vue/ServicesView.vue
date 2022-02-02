<script setup>
   import ContactUs from "../components/ContactUs.vue";
</script>
<template>
    <div class="border-top p-3">
        <article class="container-custom my-3">
            <div class="container-fluid">
                <div class="fv-title-normal fvSlideOn">
                        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp;  NOS SERVICES</h3>
                    </div>
                <div class="row row-cols-3 my-3 fv-f-direc-col-sm">
                    <div class="col py-3 fvSlideOn fv-hov fv-w-100-sm" v-for="sv in services" :key="sv.id">
                        <div class="container-fluid p-0">
                            <router-link :to="`/service/${sv.id}/${sv.name}`" class="text-decoration-none">
                                <div class="row">
                                    <div class="col col-auto">
                                        <img v-if="sv.logo" :src="sv.logo" :alt="sv.name" :title="sv.name" style="width:34px; max-height:40px;">
                                        <i v-if="sv.icon" :class="`mdi ${sv.icon} mdi-36px text-fv-primary`"></i>
                                    </div>
                                    <div class="px-2 col">
                                        <div class="fv-title-big">
                                            <h6 class="fw-bold oswald-bold text-dark"> {{ sv.name }} </h6>
                                        </div>
                                        <div class="fv-title-normal">
                                            <h6 class="text-black-50"> {{ sv.content.slice(0, 100) }} ... </h6>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
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
            services: [],
        }
    },
    methods: {
        getData: function() {
            this.$ax.get(this.$api_url + '/api/services/', this.$httpOptions).then( (e) => {
                this.services = e.data.results;
            });
        },
    },
    mounted() {
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
}
</script>