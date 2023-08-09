<template>
    <Head title="Our Activity" />
    <AppLayout>
        <div class="max-w-[1300px] mx-auto px-2 bg-slate-300">
            <div class="bg-white p-5">
                <div class="pb-5">
                    <h1 class="text-4xl text-center font-bold">
                        All Activities
                    </h1>
                    <div v-if="message" class="bg-pink-300 px-5 py-3 mt-5 relative w-1/2 text-center mx-auto">
                        {{ message }}
                        <i @click="closeMessage" class='bx bx-x absolute right-1 top-0 text-slate-500 text-xl cursor-pointer'></i>
                    </div>
                </div>
                <div class="text-center flex gap-5 justify-center mb-5">
                    <button @click="isArticles = true" :class="{'text-pink-500' : isArticles}">Articles</button>
                    <button @click="isArticles = false" :class="{'text-pink-500' : !isArticles}">Videos</button>
                </div>
                <div v-if="isArticles" class="flex justify-center">
                    <Article :articles="articles" />
                </div>
                <div v-if="!isArticles" class="flex justify-center">
                    <Video />
                </div>
            </div>
        </div>
    </AppLayout>

</template>

<script setup>
    import { Head, usePage } from '@inertiajs/vue3';
    import Article from './Article.vue';
    import Video from './Video.vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { ref } from 'vue';

    const {msg, articles} = defineProps(['articles', 'msg']);
    const isArticles = ref(true);
    const message = ref(msg ?? null);

    // method for close flash message
    const closeMessage = () => {
        message.value = null;
    }
</script>