<template>
    <!-- club -->
    <div class="roun ded-md shadow-md p-2 mx-auto max-w-[1300px] bg-white">

        <h1 class="text-center font-bold text-slate-700 text-5xl py-10 border-pink-500">
            Club Terbaru
        </h1>

        <div class="mt-5 flex gap-2 flex-wrap justify-center">

            <div 
                :style="`background-image:url('https://sm.ign.com/ign_me/news/c/community-/community-is-finally-getting-its-long-promised-movie_xvd6.jpg')`"
                class="w-full md:w-1/3 lg:w-1/5 h-[300px] bg-gray-500 bg-cover bg-center relative flex items-center justify-center">

                <a class="" id="link" href="#">
                    <div id="overlay" class="absolute inset-0 bg-black opacity-50 transition ease-in-out"></div>
                    <div class="relative z-10 text-slate-200 text-2xl text-center">
                        <div class="font-bold">
                            Club Bali Kuta
                        </div>
                    </div>
                </a>

            </div>
            <div 
                :style="`background-image:url('https://sm.ign.com/ign_me/news/c/community-/community-is-finally-getting-its-long-promised-movie_xvd6.jpg')`"
                class="w-full md:w-1/3 lg:w-1/5 h-[300px] bg-gray-500 bg-cover bg-center relative flex items-center justify-center">

                <a c lass="" id="link" href="#">
                    <div id="overlay" class="absolute inset-0 bg-black opacity-50 transition ease-in-out"></div>
                    <div class="relative z-10 text-slate-200 text-2xl text-center">
                        <div class="font-bold">
                            Club Bali Kuta
                        </div>
                    </div>
                </a>



            </div>
            <div 
                :style="`background-image:url('https://sm.ign.com/ign_me/news/c/community-/community-is-finally-getting-its-long-promised-movie_xvd6.jpg')`"
                class="w-full md:w-1/3 lg:w-1/5 h-[300px] bg-gray-500 bg-cover bg-center relative flex items-center justify-center">

                <a class="" id="link" href="#">
                    <div id="overlay" class="absolute inset-0 bg-black opacity-50 transition ease-in-out"></div>
                    <div class="relative z-10 text-slate-200 text-2xl text-center">
                        <div class="font-bold">
                            Club Bali Kuta
                        </div>
                    </div>
                </a>



            </div>
            <div   
                :style="`background-image:url('https://sm.ign.com/ign_me/news/c/community-/community-is-finally-getting-its-long-promised-movie_xvd6.jpg')`"
                class="w-full md:w-1/3 lg:w-1/5 h-[300px] bg-gray-500 bg-cover bg-center relative flex items-center justify-center">

                <a class="" id="link" href="#">
                    <div id="overlay" class="absolute inset-0 bg-black opacity-50 transition ease-in-out"></div>
                    <div class="relative z-10 text-slate-200 text-2xl text-center">
                        <div class="font-bold">
                            Club Bali Kuta
                        </div> 
                    </div>
                </a>

            </div>
        </div>
        <div class="my-10 text-center">
            <a href='#' class="py-3 px-10 bg-pink-600 rounded-3xl text-white hover:text-pink-200">
                Lihat Semua Club
            </a>
        </div>
    </div>
</template>
<script setup>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide } from 'vue3-carousel';
</script>

<style scoped>
#link:hover #overlay {
    opacity: 0.2;
}
</style>