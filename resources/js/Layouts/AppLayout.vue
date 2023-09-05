<script setup>
    import Navbar from "@/Layouts/navbar/Navbar.vue";
    import Footer from "@/Layouts/footer/Footer.vue";
    import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head>
        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
        <link rel="manifest" href="/favicons/site.webmanifest">
    </Head>
    <Navbar />
    <div class="bg-slate-300 mt-16 relative z-10">
        <slot/>
    </div>
    <Footer/>
</template>