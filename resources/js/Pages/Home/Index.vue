<template>
    <Head title="Homepage" />
    <Navbar />
    <h1 class="text-center">
        helo world
    </h1>

    <Link :href="route('login')">Login</Link>
</template>

<script setup>
    import {Head, Link} from '@inertiajs/vue3';
    import Navbar from '@/Layouts/navbar/Navbar.vue';
</script>