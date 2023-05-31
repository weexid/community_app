<template>
    <div v-if="props.isSearch" class="fixed inset-0 bg-pink-500">
        <div class="relative">
            <i @click="handleClick" class="absolute cursor-pointer top-0 right-0 text-slate-200 text-4xl bx bx-x"></i>
        </div>
        <div class="flex items-center flex-col gap-5 mt-10">
            <input v-if="isSearch" @input="fetchData" v-model="query" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 p-2 w-4/5" placeholder="Search activities or club here">
            <!-- loading -->
            <div class="text-center text-white mt-2" v-if="isLoading">
                Loading...
            </div>
            <!-- loading -->
            <div v-if="searchResult && !isLoading" class="bg-white w-4/5">
                <div class="text-center py-2 text-md font-semibold">
                    Hasil Pencarian
                </div>
                <hr>
                <div v-if="searchResult.clubs.length === 0 && searchResult.activities.length === 0" class="text-center p-2" >
                    Tidak ada hasil untuk kata "{{ query }}"
                </div>
                <div v-if="searchResult.clubs.length > 0" class="p-2">
                    <h2 class="font-semibold text-md mb-2">Clubs:</h2>
                    <div class="content-club-searched">
                        <ol>
                            <a v-for="item in searchResult.clubs" href="#" class="hover:text-pink-700">
                                <li>{{ item.club_title }}</li>
                            </a>
                    
                        </ol>
                    </div>
                </div>
                <hr>
                <div v-if="searchResult.activities.length > 0" class="p-2">
                    <h2 class="font-semibold text-md mb-2">Activities:</h2>
                    <div class="content-club-searched">
                        <ol>
                            <a v-for="item in searchResult.activities" href="#" class="hover:text-pink-700">
                                    <li>{{ item.title }}</li>
                            </a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- pencarian -->
</template>

<script setup>
    import { defineEmits } from 'vue';
    import {ref} from 'vue';
    import axios from 'axios';

    const props = defineProps({
        isSearch: {
            type: Boolean,
            required: true,
        }
    });

    const query = ref('');
    const searchResult = ref(null);
    const isLoading = ref(false);

    const fetchData = async () => {
        
        if(query.value === "") {
            searchResult.value = null;
        }
        else{

            isLoading.value = true;

            try {
                const response = await axios.get('/search?query=' + query.value);

                const res_data = response.data;

                searchResult.value = res_data;
                // console.log(searchResult.value);
                
            } catch (err) {
                console.error("Terdapat kesalahan dalam request". err);
            }
            isLoading.value = false;
        }
        
    }

    const emmits = defineEmits(['close']);


    const handleClick = () => {
        emmits('close');
    }

</script>