<template>
    <!-- Desktop nav -->
    <div class="flex flex-wrap justify-end gap-1 items-center hidden md:flex">
        <Link href="/" :class="{ 'active': $inertia.page.url === '/' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all">Home</Link>
        <Link :href="route('activity.index')" :class="{ 'active': $inertia.page.url === '/activities' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Activities</Link>
        <Link :href="route('clubs.index')" :class="{ 'active': $inertia.page.url === '/clubs' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Clubs</Link>
        <a href="#" :class="{ 'active': $inertia.page.url === '/about' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >About</a>

        <!-- jika user belum login -->
        <a href="#" :class="{ 'active': $inertia.page.url === '/login' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Login</a>
        <a href="#" :class="{ 'active': $inertia.page.url === '/register' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Register</a>
        <!-- jika user belum login -->

        <!-- jika user login tampilkan ini -->
        <a href="#" :class="{ 'active': $inertia.page.url === '/profile' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Profile</a>

        <!-- dashboard untuk admin dan ketua club -->
        <a href="#" :class="{ 'active': $inertia.page.url === '/dashboard' }" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all">Dashboard</a>

        <a href="#" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 hover:text-slate-700 transition-all"> Logout</a>
        <!-- jika user login tampilkan ini -->

        <!-- Search button -->
        <div class="text-white cursor-pointer ease-in-out flex items-center gap-2">
            <i @click="onOpenSearch" class='text-xl bx bx-search'></i>
        </div>
    </div>
    <!-- Desktop Nav -->
</template>

<script setup>
    // import { defineEmits } from 'vue';
    import { Link } from '@inertiajs/vue3';

    const emmits = defineEmits(['toggle', 'openSearch']);

    const onOpenSearch = () => {
        emmits('openSearch');
    }


</script>