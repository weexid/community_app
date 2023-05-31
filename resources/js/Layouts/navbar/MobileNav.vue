<template>
    <!-- Mobile nav -->
    <div class="flex gap-3 justify-between items-center text-sm md:hidden relative">
        <!-- Search button -->
        <div class="text-white cursor-pointer ease-in-out flex items-center gap-2">
            <i @click="onOpenSearch" class='text-xl bx bx-search'></i>
        </div>
        <!-- burger icons -->
        <div @click="toggle" class="text-white cursor-pointer transition-all">
            <i class="text-xl" :class="{ 'bx bx-x': props.isOpen, 'bx bx-menu': !props.isOpen }"></i>
        </div>

        <!-- overlay -->
        <div @click="toggle" v-if="props.isOpen" class="fixed inset-0 bg-black opacity-0 cursor-pointer z-10"></div>
        
        <!-- Menu untuk mobile -->
        <div  v-if="props.isOpen" class="flex flex-col bg-pink-400 rounded-md absolute top-9 right-0 z-50 min-w-50 md:hidden mobile-nav transition-all">
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">Home</a>
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">Activities</a>
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">Clubs</a>
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">About</a>

            <!-- jika user belum login -->
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">Login</a>
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">Register</a>
            <!-- jika user belum login -->
        
            <!-- jika user login tampilkan ini -->
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 ">Profile</a>

            <!-- dashboard untuk admin dan ketua club -->
            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 font-semibold text-yellow-800 font-semi-bold">Dashboard</a>

            <a href="#" @click="toggle" class="py-2 px-5 hover:bg-pink-200 font-semibold text-red-800"> Logout</a>
            <!-- jika user login tampilkan ini -->
        </div>
    </div>
    <!-- Mobile nav -->
</template>

<script setup>
    import { defineEmits } from 'vue';
    const props = defineProps({
        isOpen : {
            type: Boolean,
            required: true,
        }
    });

    const emmits = defineEmits(['toggle', 'openSearch']);
    const toggle = () => {
        emmits('toggle');
    }

    const onOpenSearch = () => {
        emmits('openSearch');
    }


</script>