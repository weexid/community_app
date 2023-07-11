<template>
    <!-- club -->
    <div class="roun ded-md shadow-md p-2 mx-auto max-w-[1300px] bg-white">

        <h1 class="text-center font-bold text-slate-700 text-5xl py-10 border-pink-500">
            Club Terbaru
        </h1>

        <div class="mt-5 flex gap-2 flex-wrap justify-center">

            <div v-for="club in clubs" :key="club.slug"
                :style="{ 'background-image': club.image ? `url('/storage/images/${club.image}')` : `url('${club.image_url}')` }"
                class="w-full md:w-1/3 lg:w-1/5 h-[300px] bg-gray-500 bg-cover bg-center relative flex items-center justify-center">

                <Link class="" id="link" :href="`/club/${club.slug}`">
                    <div id="overlay" class="absolute inset-0 bg-black opacity-50 transition ease-in-out"></div>
                    <div class="relative z-10 text-slate-200 text-2xl text-center">
                        <div class="font-bold">
                            {{ club.club_title }}
                        </div>
                        <div v-if="club.club_tagline" class="text-sm">{{ club.club_tagline }}</div>
                    </div>
                </Link>

            </div>
        </div>
        <div class="my-10 text-center">
            <Link :href="route('clubs.index')" class="py-3 px-10 bg-pink-600 rounded-3xl text-white hover:text-pink-200">
                Lihat Semua Club
            </Link>
        </div>
    </div>
</template>
<script setup>
    import {Link} from '@inertiajs/vue3';
    defineProps({
        clubs: {
            type: Object,
            required: true,
        }
    })
</script>

<style scoped>
#link:hover #overlay {
    opacity: 0.2;
}
</style>