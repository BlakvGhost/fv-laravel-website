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
                        <h3 class="text-fv-primary"><span class="dbslash">//</span> &nbsp;  POURQUOI NOUS ? </h3>
                    </div>
                    <div class="fv-title-big">
                        <h3 class="text-dark fw-bolder oswald-bold">
                           <i :class="`mdi ${activity.icon} mdi-36px align-middle opacity-50`"></i> | {{ activity.name }} | <sup style="font:inherit" data-fv-anim='countdown' :data-fv-data='activity.value'></sup>
                        </h3>
                </div>
                <div class="fv-title-normal fvSlideOn">
                    <blockquote class="text-black-50 p-2">
                        <div style="font-size:22px">
                            {{ activity.content }}
                        </div>
                    </blockquote>
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
            activity: {},
        }
    },
    methods: {
        getData: function() {
            try {
                this.$ax.get(`${this.$api_url}/api/whyus/${this.$route.params.id}/`).then( (e) => {
                    this.activity = e.data
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
            new fJs.NumberAutoCount();      
    },
}
</script>