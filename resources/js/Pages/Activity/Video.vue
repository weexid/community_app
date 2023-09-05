<template>
    <div class="w-1/2 p-3">
        <div class="pb-3">
            <h1 class="text-3xl font-bold text-center">All Videos</h1>
        </div>
        <div class="flex flex-wrap gap-5 justify-center" v-if="!isLoading">
            <!-- {{ videos }} -->
            <Link :href="route('activity.show', video.slug)" class="w-[45%]" v-for="video in videos" :key="video.id">
                <div class="w-full">
                    <img class="rounded-xl" :src="`https://img.youtube.com/vi/${video.thumbnail}/mqdefault.jpg`" :alt="video.title + '-' + video.id" />
                </div>
                <div class="p-3">
                    <h2 class="text-md font-bold">{{ video.title }}</h2>
                </div>
                <div class="flex justify-between gap-2 px-3 pb-3 text-sm">
                    <div v-if="video.tags.length > 0">
                        <span class="inline-block mr-2 hover:text-pink-500 text-[12px]" v-for="tag in video.tags">
                            {{ tag.tag_name }}
                        </span>
                    </div>
                    <div>
                        {{ video.club.club_title }}
                    </div>
                </div>
            </Link>          
        </div>
        <div class="mt-10 flex items-center justify-end gap-5 text-slate-600">
            <button v-if="currentPage > 1" @click="PrevPage" class="text-4xl">
                &laquo
            </button>
            <div>
                {{ currentPage }}
            </div>
            <button v-if="currentPage < lastPage" @click="nextPage" class="text-4xl">
                &raquo
            </button>
        </div>
    </div>

    <!-- {{ videos }} -->
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import { onMounted } from 'vue';
    import axios from 'axios';


    const videos = ref([]);
    const isLoading = ref(false);
    const currentPage = ref(1);
    const lastPage = ref(0);


    onMounted(() => {
        isLoading.value = true;
        axios.get('/activity/videos').then(res => {
            const result = res.data;
            videos.value = result.data;
            currentPage.value = result.current_page;
            lastPage.value = result.last_page
        })
        isLoading.value = false;
    });


    const nextPage = async () => {
        if(currentPage.value === lastPage.value) return;
        if(isLoading.value) return;

        isLoading.value = true;
        try {
            const nextPage = currentPage.value + 1;
            const response = await axios.get('activity/videos?page=' + nextPage);
            const result = response.data;

            videos.value = result.data;
            currentPage.value = result.current_page;

        } catch (error) {
            console.error(error);
        }
        isLoading.value = false;
        scrollToTop();
    }

    const PrevPage = async () => {
        if(currentPage.value === 1) return;
        if(isLoading.value) return;

        isLoading.value = true;
        try {
            const nextPage = currentPage.value - 1;
            const response = await axios.get('activity/videos?page=' + nextPage);
            const result = response.data;

            videos.value = result.data;
            currentPage.value = result.current_page;

        } catch (error) {
            console.error(error);
        }
        isLoading.value = false;
        scrollToTop();
    }

    const scrollToTop = () => {
        const options = {
            top: 0,
            left: 0,
            behaviour: 'smooth',
        };

        window.scrollTo(options);
    }
</script>