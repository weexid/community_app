<template>
    <div class="w-1/2 p-3">
        <div class="pb-3">
            <h1 class="text-3xl font-bold text-center">All Articles</h1>
        </div>
        <!-- {{ articles }} -->
        <div v-for="article in articles.data" class="">
            <Link :href="route('activity.show', article.slug)" class="p-3 mb-3 flex gap-5 items-start border rounded-md">
                <div v-if="article.thumbnail" class="w-[20%] pt-2">
                    <img class="w-full" :src="'storage/images/' + article.thumbnail" alt="article-img">
                </div>

                <div class="w-[80%]">
                    <h1 class="text-xl font-bold">
                        {{ article.title }}
                    </h1>
                    <p>
                        {{ article.description }}
                    </p>
                    <div class="flex justify-between items-end">
                        <div class="w-[65%] text-sm" v-if="article.tags.length > 0">
                            tags: 
                            <span class="text-pink-500 inline-block mr-3" v-for="tag in article.tags">
                                {{ tag.tag_name }}
                            </span>
                        </div>
                        <div class="ml-auto">
                            {{ article.club.club_title }}
                        </div>
                    </div>
                </div>
            </Link>
        </div>
        <div class="mt-10 flex items-center justify-end gap-5 text-slate-600">
            <Link v-if="articles.current_page > 1" :href="route('activity.index', {'page': articles.current_page - 1})" class="text-4xl">
                &laquo
            </Link>
            <div>
                {{ articles.current_page }}
            </div>
            <Link v-if="articles.current_page < articles.last_page" :href="route('activity.index', {'page': articles.current_page + 1})" class="text-4xl">
                &raquo
            </Link>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        'articles' : Object,
    });
</script>