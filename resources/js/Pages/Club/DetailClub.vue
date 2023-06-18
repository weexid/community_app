<script setup>
    import { Head } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { onMounted, ref } from 'vue';
    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide } from 'vue3-carousel';

    const props = defineProps({
        club: {
            type: Object,
            required: true,
        },
    });

    const club = ref(props.club);

    onMounted(() => {
        console.log(club.value);
    });
    
    
</script>
<template>
    <Head :title="club.club_title"/>
    <AppLayout>
        <div class="bg-white max-w-[1300px] mx-auto">
            <div class="py-2">
                <Carousel class="z-1" :autoplay="5000" :wrap-around="true">
                    <Slide v-for="item in club.carousel" key="item.id">
                        <div
                        :style="item.image ? `background-image: url('/storage/images/${item.image}')` : `background-image: url(${item.image_url})`"
                        class="h-[500px] w-full bg flex justify-center items-center bg-no-repeat bg-cover relative"> 
                            <div class="absolute inset-0 bg-black opacity-20 z-1"></div>
                            <div class="text-6xl text-white z-10">
                                <h1 class="drop-shadow-md">{{ item.heading }}</h1>
                                <p v-if="item.sub_heading" class="text-xl text-white">{{ item.sub_heading }}</p>
                                <div class="mt-20">
                                    <a
                                    v-if="item.cta_link"
                                    class="py-2.5 px-8 text-xl text-white bg-pink-500 rounded-3xl border-2 border-pink-500 transition-[background-color] hover:bg-transparent" 
                                    :href="item.cta_link">{{ item.cta_text }}</a>
                                </div>
                            </div>
                        </div>
                    </Slide>

                </Carousel>
                <h1 class="text-center text-4xl py-5 font-bold">{{ club.club_title }}</h1>
                <p>{{ club.club_tagline }}</p>
            </div>
        </div>
    </AppLayout>
</template>