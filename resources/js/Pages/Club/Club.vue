<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { onMounted, ref, computed, watch, TransitionGroup } from 'vue';
    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide } from 'vue3-carousel';

    const props = defineProps({
        club: {
            type: Object,
            required: true,
        },
        members: {
            type: Array,
        }, 
        activities: {
            type: Array,
        }
    });

    const club = ref(props.club);
    const displayActivities = ref([]);
    const itemToShow = ref(5);
    const incrementBy = ref(5);

    function sliceActivities() {
        displayActivities.value = props.activities.slice(0, Math.min(displayActivities.value.length + itemToShow.value, props.activities.length));
    }

    function loadMore() {
        itemToShow.value += incrementBy.value;
        sliceActivities();
    };

    const loadButton = computed(() => {
        if(displayActivities.value.length < props.activities.length) {
            return true;
        } else
            return false;
    });

    onMounted(() => {
        sliceActivities();
        if(!isShowAllMember.value) {
            visibleMembers.value = props.members.slice(0,5);
        }
    });

    // members control
    const visibleMembers = ref([]);
    const isShowAllMember = ref(false);

    function showAllMember() {
        isShowAllMember.value = true;
        visibleMembers.value = props.members;
    }

    function hideMembers() {
        isShowAllMember.value = false;
    }

    const filteredMembers = computed(() => {
        if(isShowAllMember.value) {
            return props.members;
        }else{
            return props.members.slice(0, 5);
        }
    });

    watch(filteredMembers, (newArr) => {
       return visibleMembers.value = newArr;
    });


</script>


<template>
    <Head :title="club.club_title"/>
    <AppLayout>
        <div class="bg-white max-w-[1300px] mx-auto">
            <div class="py-2">
                <div class="w-full bg-cover bg-center p-20 relative" :style="{ 'background-image': club.image ? `url('/storage/images/${club.image}')` : `url('${club.image_url}')` }">
                    <div class="absolute inset-0 bg-black opacity-30 z-1"></div>
                    <h1 class="text-white font-bold text-5xl z-5 relative text-center">
                        {{ club.club_title }}
                    </h1>
                    <p class="text-white relative z-5 text-sm text-center" v-if="club.club_tagline">
                        {{ club.club_tagline }}
                    </p>
                    <p class="mt-2 text-white relative z-5 text-sm font-bold text-center" v-if="club.description">
                        {{ club.description }}
                    </p>

                    <div class="absolute z-5 bottom-[-20px] right-10 flex gap-2">
                        <!-- join club hanya muncul user.role == null -->
                        <Link href="#" class="bg-pink-500 py-2 px-5 rounded-3xl text-white" >Join Club</Link>
                        <!-- edit hanya muncul jika user.role == pres club ini atau admin -->
                        <Link :href="route('club.edit', club.slug)" class="bg-pink-500 py-2 px-5 rounded-3xl text-white" >Edit Club</Link>
                        <!-- exit club hanya muncul jika user.club_id == this.club.id -->
                        <!-- tapi sepertinya untuk fitur leave group akan di akses oleh presiden masing2 -->
                        <!-- <Link :href="route('club.edit', club.slug)" class="bg-pink-500 py-2 px-5 rounded-3xl text-white" >Leave Club</Link> -->
                    </div>  
                </div>
                <div v-if="club.carousel.length > 0" class="pt-20 pb-5 text-center">
                    <h2 class="text-4xl">
                        Club Announcement
                    </h2>
                </div>
                
                <Carousel class="z-1" :autoplay="5000" :wrap-around="true">
                    <Slide v-for="item in club.carousel" key="item.id">
                        <div
                        :style="item.image ? `background-image: url('/storage/images/${item.image}')` : `background-image: url(${item.image_url})`"
                        class="h-[500px] w-full bg flex justify-center items-center bg-no-repeat bg-cover relative"> 
                            <div class="absolute inset-0 bg-black opacity-20 z-1"></div>
                            <div class="text-6xl text-white z-10">
                                <h1 class="drop-shadow-md">{{ item.heading }}</h1>
                                <p v-if="item.sub_heading" class="text-xl text-white">{{ item.sub_heading }}</p>
                                <div class="mt-20">
                                    <a
                                    v-if="item.cta_link"
                                    class="py-2.5 px-8 text-xl text-white bg-pink-500 rounded-3xl border-2 border-pink-500 transition-[background-color] hover:bg-transparent" 
                                    :href="item.cta_link">{{ item.cta_text }}</a>
                                </div>
                            </div>
                        </div>
                    </Slide>

                </Carousel>
                <!-- members & Activity section -->
                <div class="flex flex-wrap justify-center p-5 gap-5">
                    <!-- <div>
                        {{ visibleMembers }} <br>
                        {{ isShowAllMember }} <br>
                        <button @click="showAllMember">Show</button>
                        <button @click="hideMembers">Hide</button>
                    </div> -->
                    <div 
                    v-if="props.members.length > 0"
                    class="p-5 border border-slate-300 rounded-xl w-1/4 h-full relative">
                        <h2 class="text-2xl pb-2 font-bold">Members:</h2>

                        <TransitionGroup name="list" tag="div">
                            <div class="transition ease-in-out" v-for="member in visibleMembers" :key="member.id">
                                <h2 class="text-md font-semibold">{{member.username}}</h2>
                                <p class="text-sm text-slate-500 mt-[-5px]" >{{ member.role }}</p>
                            </div>
                        </TransitionGroup>
                            <div @click="showAllMember" v-if="!isShowAllMember" class="absolute bg-white left-1/2 transform -translate-x-1/2 w-10 h-10 border border-2 border-slate-300 rounded-full flex items-center justify-center cursor-pointer hover:border-pink-400">
                                <i class='bx bx-chevron-down'></i>
                            </div>
                            <div @click="hideMembers" v-if="isShowAllMember" class="absolute bg-white left-1/2 transform -translate-x-1/2 w-10 h-10 border border-2 border-slate-300 rounded-full flex items-center justify-center cursor-pointer hover:border-pink-400">
                                <i class='bx bx-chevron-up'></i>
                            </div>
                    </div>

                    <!-- activity -->
                    <div class="p-5 border-slate-300 rounded-xl w-2/3">
                        <h2 class="text-3xl pb-2 font-bold">Our Club Activities</h2>
                        <div v-if="props.activities.length > 0" class="pt-5">
                            <TransitionGroup name="list" tag="div">
                                <div v-for="activity in displayActivities" key="activity.id" class="w-full py-3 px-2 border border-slate-300 rounded-md mb-2">
                                    <div class="flex justify-center gap-2">
                                        <div class="w-[20%]">
                                            <Link :href="'#/' + activity.slug">
                                                <img class="w-full" :src="'/storage/images/' + activity.image" :alt="activity.title">
                                            </Link>
                                        </div>
                                        <div class="w-[80%] p-2">
                                            <Link :href="'#/'  + activity.slug">
                                                <h2 class="text-xl text-slate-900 font-semibold">
                                                    {{ activity.title }}
                                                </h2>
                                            </Link>
                                            <p>
                                                {{ activity.content }}
                                            </p>

                                            <span class="pt-5 text-sm text-slate-700">
                                                Publish on: {{ activity.date }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </TransitionGroup>
                                <div v-if="loadButton" class="text-center cursor-pointer mt-10">
                                    <div class="inline-block py-2 px-3 rounded-md hover:bg-pink-500" @click="loadMore"> Load More </div>
                                </div>
                            </div>


                        <div v-else>
                            <h1>Belum ada activity!</h1>
                        </div>
                    </div>

                    <!-- <div>
                        <div v-for="item in displayActivities">
                            {{ item.title }}
                        </div>
                        -------------------
                        <div v-for="item in props.activities">
                            {{ item.title }}
                        </div>
                    </div>

                    <div>
                        {{ loadButton }}
                        {{ itemToShow }}
                        <p v-if="loadButton" class="p-2 bg-pink-500" @click="loadMore">load more</p>
                    </div> -->


                    <!-- activity -->
                </div>
                <!-- members & Activity section -->
                <!-- {{ props.activities }} -->
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
    .list-move, /* apply transition to moving elements */
    .list-enter-active,
    .list-leave-active {
        transition: all 0.5s ease-in-out;
    }

    .list-enter-from,
    .list-leave-to {
        opacity: 0;
        transform: translateY(-10px);
    }

    /* ensure leaving items are taken out of layout flow so that moving
    animations can be calculated correctly. */
    .list-leave-active {
        position: absolute;
    }
</style>