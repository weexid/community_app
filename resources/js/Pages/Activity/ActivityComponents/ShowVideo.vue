<template>
    <div class="flex gap-5">
        <div class="w-[75%] h-[85vh]">
            <div class="w-[90%] mx-auto">
                <div class="text-center flex justify-center relative w-full pb-[56.25%] h-0 mb-5">
                    <iframe class="absolute w-full h-[100%]" :src="`https://www.youtube.com/embed/${activity.video[0].video_src}`" frameborder="0" allowfullscreen></iframe>
                </div>
                <div>
                    <h1 class="text-xl">{{activity.title}}</h1>
                    <p class="text-slate-700">{{ activity.description }}</p>
                </div>
            </div>
        </div>

        <div class="w-[25%]">
            <PostSidebar>
                <div>
                    <h2 class="text-xl font-bold mb-3">Related Videos</h2>
                    <div class="w-full border p-2 mb-2" v-for="item in relatedVideo">
                        <h3 class="text-md font-semibold">{{ item.title }}</h3>
                        <img :src="`https://img.youtube.com/vi/${item.thumbnail}/mqdefault.jpg`" :alt="item.title">
                    </div>
                </div>
            </PostSidebar>
        </div>
    </div>
</template>

<script setup> 
    import PostSidebar from '@/Components/PostSidebar.vue';
    const {activity, relatedVideo} = defineProps(['activity', 'relatedVideo']);
</script>