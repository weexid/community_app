<template>
    <div class="bg-pink-500 p-3 flex justify-between items-center">
        <div class="text-white text-white text-2xl">
            Charities
        </div>

        <div class="flex gap-3 justify-between items-center text-sm sm:hidden relative">
            <div>
                Search
            </div>

            <div class="cursor-pointer">
                Dropdown
            </div>

            <!-- overlay -->
            <div class="fixed inset-0 bg-black opacity-50"></div>

            <!-- Menu untuk mobile -->
            <div class="flex flex-col bg-pink-400 rounded-md absolute top-5 right-0 z-2 sm:hidden">
                <a href="" class="py-2 px-5 hover:bg-pink-200 rounded-t-md">Home</a>
                <a href="" class="py-2 px-5 hover:bg-pink-200 ">Activities</a>
                <a href="" class="py-2 px-5 hover:bg-pink-200 ">Clubs</a>
                <a href="" class="py-2 px-5 hover:bg-pink-200 ">About</a>
                <a href="" class="py-2 px-5 hover:bg-pink-200  rounded-b-md"> Hi, {{ truncater("I Made Sudarta Putra Dinata Sanjaya", 15)}}</a>
            </div>

        </div>
    </div>
</template>
<script setup>
    import truncater from '@/utils/truncater';
    import { ref } from 'vue';

    
</script>