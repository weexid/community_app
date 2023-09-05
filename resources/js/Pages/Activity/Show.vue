<template>
    <Head :title="activity.title ?? 'Not Found'"/>
    <AppLayout>
        <div class="max-w-[1300px] mx-auto px-2 bg-slate-300">
            <div class="bg-white p-5">
                <div v-if="activity.article">
                    <ShowArticle :relatedActivity="relatedActivity" :activity="activity" />
                </div>

                <div v-else>
                    <ShowVideo :activity="activity" :relatedVideo="relatedActivity"/>
                </div>
            </div>
        </div>
    </AppLayout>

    
</template>

<script setup>
    import { Head, } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ShowArticle from '@/Pages/Activity/ActivityComponents/ShowArticle.vue';
    import ShowVideo from '@/Pages/Activity/ActivityComponents/ShowVideo.vue';
    
    const {activity, relatedActivity} = defineProps(['activity', 'relatedActivity']);

</script>