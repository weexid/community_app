<template>
    <Head title="Homepage" />
    <AppLayout>
        <MainCarousel :carousels="carousel" />
        <ClubSection :clubs="club"/>
        <ActivitySection :activities="activity" />
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
        club: Object,
        activity: Object,
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