<script setup>
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';

    defineProps({
        clubs: {
            type:Object
        },
    });

</script>

<template>
    <Head title="Clubs" />
    <AppLayout>
        <div class="max-w-[1300px] mx-auto px-2 bg-slate-300">
            <div class="bg-white p-5">
                <div class="text-4xl font-bold text-center mt-10">
                    <h1>Daftar Club</h1>
                    <!-- success  -->
                    <div v-if="$page.props.flash.message">
                        {{ $page.props.flash.message }}
                    </div>
                    
                </div>
                <div v-if=clubs class="flex flex-wrap gap-5 justify-center mt-10">
                    <div v-for="item in clubs" class="w-full md:w-1/3 xl:w-1/5 border shadow-xl rounded-md">
                        <div class="w-full">
                            <Link :href="route('club', item.slug)">
                                <img :src="item.image ? '/storage/images/' + item.image  : item.image_url" :alt="item.club_title" class="w-full h-[250px] rounded-t-md">
                            </Link>
                        </div>
                        <div class="text-center font-bold py-5 text-xl">
                            <h1>{{ item.club_title }}</h1>
                        </div>
                        <div class="p-2">
                            <span>Total Member : {{ item.members_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>