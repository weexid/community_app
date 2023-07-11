<script setup>
    import {Link} from '@inertiajs/vue3';
    import {ref, onMounted, computed } from 'vue';
    import axios from 'axios';

    const activities = ref([]);
    const currentPage = ref(0);
    const lastPage = ref(0);
    const isLoading = ref(false);

    onMounted(() =>{
        isLoading.value = true;
        axios.get('/paginate/activities').then((res) => {
            const responseData = res.data;
            activities.value = responseData.data;
            currentPage.value = responseData.current_page;
            lastPage.value = responseData.last_page;
        })
        isLoading.value = false;
    });

    const hasMoreData = computed(() => {
        return currentPage.value < lastPage.value;
    });

    const loadMore = async () => {
        if(isLoading.value) return;

        isLoading.value = true;
        try {
            const nextPage = currentPage.value + 1;
            const response = await axios.get('paginate/activities?page=' + nextPage);
            const data = response.data;

            // iniArr.value = [...iniArr.value, ...data.data];
            // console.log(data.data);
            activities.value = [...activities.value, ...data.data];
            currentPage.value = data.current_page;


        } catch (error) {
            console.error('Cannot fetch the data', error);
        }
        
        isLoading.value = false;

    }
</script>

<template>
    <!-- Activities -->
    <div class="rounded-md shadow-md p-2 mx-auto max-w-[1300px] bg-white">
        <div class="text-center font-bold text-slate-700 text-5xl py-10">
            Aktivitas Terbaru
        </div>
        <div class="mt-5 flex gap-3 flex-wrap justify-center">

            <div v-for="activity in activities" class="w-full xl:w-1/4 md:w-1/3 rounded-md p-3 border shadow-md flex gap-3 flex-col justify-start items-center relative pb-20">
                <div class="w-full">
                    <a :href="'/activity/'+ activity.slug">
                        <img class="w-full md:max-h-[200px]" :src="'/storage/images/'+ activity.image" alt="thumbnail">
                    </a>
                </div>
                <div class="">
                    <div class="text-xl font-semibold text-slate-800">
                        <a :href="'/activity/' + activity.slug">
                            {{ activity.title }}
                        </a>
                        
                    </div>
                    <div class="text-sm text-slate-500 pr-5">

                        {{ activity.content}}
                        
                    </div>
                    <div class="absolute bottom-5 right-5">
                        <div class="mt-5 flex flex-col items-end gap-2">
                            <div class="flex justify-end items-center gap-2 text-slate-500">
                                <span class="bx bx-show"></span>
                                <span class="text-sm text-slate-600">{{ activity.views }}</span>
                            </div>
                            <div class="bg-pink-500 py-1 px-3 text-white rounded-xl text-sm">
                                <Link :href="route('club', activity.club.slug)">
                                    {{ activity.club.club_title }}
                                </Link>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </div>

        <div v-if="hasMoreData" class="text-center py-10">
            <div class="w-1/5 mx-auto py-3 px-10 bg-pink-600 rounded-3xl text-white hover:text-pink-200">
                <span v-if="!isLoading" class="cursor-pointer" @click="loadMore">
                    Lebih Banyak
                </span>
                <span v-if="isLoading">
                    Loading...
                </span>
            </div>
        </div>
    </div>
    <!-- <pre>
        {{ activities }}
    </pre> -->
</template>