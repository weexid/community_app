<template>
    <Head title="Homepage" />
    <AppLayout>
        <MainCarousel :carousels="carousel" />
        <!-- <div v-for="item in carousel" :key="item.id">
            <div v-if="item.image">
                <img :src="`/storage/images/${item.image}`">
                <h1>{{ item.heading }}</h1>
                <h2 v-if="item.sub_heading">{{ item.sub_heading }}</h2>
                <a v-if="item.cta_link" :href="item.cta_link">{{ item.cta_text }}</a>
            </div>
            <div v-if="item.image_url">
                <img :src="item.image_url">
                <h1>{{ item.heading }}</h1>
                <h2 v-if="item.sub_heading">{{ item.sub_heading }}</h2>
                <a v-if="item.cta_link" :href="item.cta_link">{{ item.cta_text }}</a>
            </div>
        </div> -->
        <ClubSection/>
        <ActivitySection />
    </AppLayout>

    <!-- scroller -->
    <div v-if="!isAtTop" @click="scrollToTop" class="w-10 h-10 bg-slate-200 flex items-center justify-center rounded-full text-slate-400 hover:bg-slate-500 hover:text-slate-200 transition ease-in-out cursor-pointer fixed bottom-5 right-5">
        <i class='text-2xl bx bx-up-arrow-alt'></i>
    </div>
    <!-- scroller -->
</template>

<script setup>
    import {Head} from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ClubSection from '@/Pages/Home/ClubSection.vue';
    import ActivitySection from '@/Pages/Home/ActivitiySection.vue';
    import MainCarousel from '@/Pages/Home/MainCarousel.vue'
    import { onMounted } from 'vue';
    import { ref } from 'vue';
    import { onBeforeUnmount } from 'vue';

    const isAtTop = ref(true);


    defineProps({
        carousel : Object,
    })


    onMounted(() => {
        window.addEventListener('scroll', handleScroll);
    })

    onBeforeUnmount( () => {
        window.removeEventListener('scroll', handleScroll);
    })

    function handleScroll() {
        isAtTop.value = window.pageYOffset === 0;
    }

    function scrollToTop () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    }
</script>