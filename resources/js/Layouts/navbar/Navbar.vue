<template>
    <div class="bg-pink-500 p-4 flex justify-between items-center fixed top-0 right-0 left-0 w-full z-50">
        <div class="text-white text-white text-2xl">
            Charities
        </div>
        <!-- Desktop Nav -->
        <div class="hidden md:block">
            <DesktopNav @openSearch="() => isSearch = !isSearch"/>
        </div>
        
        <!-- Buat mobile nav lebih modular-->
        <div class="block md:hidden">
            <MobileNav 
                :isOpen="isOpen" 
                @toggle="() => isOpen = !isOpen"
                @openSearch="() => isSearch = !isSearch"
            />
        </div>

        <Search :isSearch="isSearch" @close="() => isSearch = !isSearch"/>
    </div>
</template>
<script setup>
    import { ref } from 'vue';
    import Search from '@/Layouts/navbar/Search.vue';
    import MobileNav from '@/Layouts/navbar/MobileNav.vue';
    import DesktopNav from '@/Layouts/navbar/DesktopNav.vue';

    const isOpen = ref(false);
    const isSearch = ref(false);

    
</script>
<style scoped>
.active{
    border-bottom: 1px solid white;
}


.content-club-searched ol > a {
    padding-bottom: 6px;
    display: block;
}

.mobile-nav a:first-child{
    border-radius: 6px 6px 0 0;
}
.mobile-nav a:last-child{
    border-radius: 0 0 6px 6px;
}
</style>