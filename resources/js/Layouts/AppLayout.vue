<script setup>
    import Navbar from "@/Layouts/navbar/Navbar.vue";
    import Footer from "@/Layouts/footer/Footer.vue";
</script>

<template>
    <Navbar />
    <div class="bg-slate-300 mt-16 z-10">
        <slot/>
    </div>
    <Footer/>
</template>