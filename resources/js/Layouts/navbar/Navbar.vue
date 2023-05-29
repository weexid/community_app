<template>
    <div class="bg-pink-500 p-4 flex justify-between items-center fixed top-0 right-0 left-0 w-full z-50">
        <div class="text-white text-white text-2xl">
            Charities
        </div>

        <div class="flex flex-wrap justify-end gap-1 items-center hidden md:flex">
            <a href="#" :class="{'active': $inertia.page.url === '/'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all">Home</a>
            <a href="#" :class="{'active': $inertia.page.url === '/activities'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Activities</a>
            <a href="#" :class="{'active': $inertia.page.url === '/clubs'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Clubs</a>
            <a href="#" :class="{'active': $inertia.page.url === '/about'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >About</a>

            <!-- jika user belum login -->
            <a href="#" :class="{'active': $inertia.page.url === '/login'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Login</a>
            <a href="#" :class="{'active': $inertia.page.url === '/register'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Register</a>
            <!-- jika user belum login -->
        
            <!-- jika user login tampilkan ini -->
            <a href="#" :class="{'active': $inertia.page.url === '/profile'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all" >Profile</a>

            <!-- dashboard untuk admin dan ketua club -->
            <a href="#" :class="{'active': $inertia.page.url === '/dashboard'}" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 transition-all">Dashboard</a>

            <a href="#" class="py-2 px-5 border-b border-transparent text-white hover:border-b hover:border-pink-200 hover:text-slate-700 transition-all"> Logout</a>
            <!-- jika user login tampilkan ini -->
        </div>

        <!-- Mobile nav -->
        <div class="flex gap-3 justify-between items-center text-sm md:hidden relative">
            <!-- Search button -->
            <div class="text-white cursor-pointer ease-in-out flex items-center gap-2">
                <i @click="() => isSearch = !isSearch" class='text-xl bx bx-search'></i>
            </div>
            <!-- pencarian -->
            <div v-if="isSearch" class="fixed inset-0 bg-pink-500">
                <div class="relative">
                    <i @click="() => isSearch = !isSearch" class="absolute cursor-pointer top-0 right-0 text-slate-200 text-4xl bx bx-x"></i>
                </div>
                <div class="flex items-center flex-col gap-5 mt-10">
                    <input v-if="isSearch" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 p-2 w-4/5" placeholder="Search activities or club here">
                    <div class="bg-white w-4/5">
                        <div class="text-center py-2 text-md font-semibold">
                            Hasil Pencarian
                        </div>
                        <hr>
                        <div class="p-2">
                            <h2 class="font-semibold text-md mb-2">Clubs:</h2>
                            <div class="content-club-searched">
                                <ol>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    
                                </ol>
                            </div>
                        </div>
                        <hr>
                        <div class="p-2">
                            <h2 class="font-semibold text-md mb-2">Activities:</h2>
                            <div class="content-club-searched">
                                <ol>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    <a href="#" class="hover:text-pink-700">
                                        <li>Makan Nasi</li>
                                    </a>
                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- burger icons -->
            <div @click="() => isOpen = !isOpen" class="text-white cursor-pointer transition-all">
                <i class="text-xl" :class="{'bx bx-x' : isOpen, 'bx bx-menu' : !isOpen}"></i>
            </div>

            <!-- overlay -->
            <div @click="() => isOpen = false" v-if="isOpen" class="fixed inset-0 bg-black opacity-0 cursor-pointer z-10"></div>

            <!-- Menu untuk mobile -->
            <div  v-if="isOpen" class="flex flex-col bg-pink-400 rounded-md absolute top-9 right-0 z-20 min-w-50 sm:hidden mobile-nav transition-all">
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">Home</a>
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">Activities</a>
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">Clubs</a>
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">About</a>

                <!-- jika user belum login -->
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">Login</a>
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">Register</a>
                <!-- jika user belum login -->
                
                <!-- jika user login tampilkan ini -->
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 ">Profile</a>

                <!-- dashboard untuk admin dan ketua club -->
                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 font-semibold text-yellow-800 font-semi-bold">Dashboard</a>

                <a href="#" @click="() => isOpen = false" class="py-2 px-5 hover:bg-pink-200 font-semibold text-red-800"> Logout</a>
                <!-- jika user login tampilkan ini -->
            </div>

        </div>
    </div>
</template>
<script setup>
    import { ref } from 'vue';

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