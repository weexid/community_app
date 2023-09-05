<template>
    <Head title="Create New Video"/>
    <AppLayout>
        <div class="max-w-[1300px] mx-auto px-2 bg-slate-300">
            <div class="bg-white p-5">
                <div class="pt-10">
                    <div class="w-1/2 mx-auto border p-5">
                        <div class="flex gap-3 mb-5">
                            <Link :href="route('activity.index')"><i class='bx bx-arrow-back'></i> Back</Link> | <Link :href="route('activity.create')">Article</Link> | <Link class="text-pink-500"  href="#">Video</Link>
                        </div>

                        <form @submit.prevent="submitData">
                            <div class="mb-2">
                                <label for="club" >Club id</label> <br>
                                <input class="w-full bg-slate-300" disabled type="text" name="club" value="Club Merak" />
                            </div>
                            <div class="mb-2">
                                <label for="title" >Title</label> <br>
                                <input v-model="title" class="w-full" type="text" placeholder="Article title" />
                                <div v-if="errors.title" class="text-sm text-red-500">
                                    <li class="list-none" v-for="error in errors.title">
                                        {{ error }}
                                    </li>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="title" >Short Description</label> <br>
                                <textarea v-model="description" class="w-full" type="text" placeholder="max 250 characters" />
                                <div class="text-sm text-red-500" v-if="errors.description">
                                    <li class="list-none" v-for="error in errors.description">
                                        {{ error }}
                                    </li>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="video-code">Youtube Video Code</label> <br>
                                <input type="text" v-model="ytCode" class="w-full" placeholder="-gfoAkVISqk">
                                <div class="text-sm text-red-500" v-if="errors.ytCode">
                                    <li class="list-none" v-for="error in errors.ytCode">
                                        {{ error }}
                                    </li>
                                </div>
                                <p class="text-sm text-slat-500">Example : https://www.youtube.com/watch?v=<span class="text-pink-500">-gfoAkVISqk</span></p>
                            </div>

                            <div class="mb-2" v-if="isValidYtCode">
                                <iframe width="560" height="315" :src="emmbedUrl" frameborder="0" allowfullscreen></iframe>
                            </div>

                            <div class="mb-2">
                                <form @submit.prevent="addNewtag">
                                    <label>Tags:</label> <br>
                                    <input v-model="tag" @input="fetchTags" class="py-1 px-3 w-full z-15" placeholder="Search or add new tag with enter" type="text">
                                    <!-- error -->
                                    <div class="text-sm text-red-500" v-if="errors.tag">
                                        <li class="list-none" v-for="error in errors.tag">
                                            {{ error }}
                                        </li>
                                    </div>
                                    <div v-if="searchedTags.length > 0" class="w-full bg-slate-200 border p-2 z-99">
                                        <ul v-if="!isLoading" class="flex gap-2 flex-wrap">
                                            <li v-for="tag in searchedTags" class="px-2 bg-pink-500 cursor-pointer rounded-xl" @click="addTag(tag)" >{{ tag.tag_name }} <span>({{tag.activities_count}})</span></li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <div class="mb-2 flex gap-5 items-center z-10">
                                <div class="flex flex-wrap items-center gap-2">
                                    <div v-for="tag in tags" :key="tag.id" class="bg-slate-300 rounded-xl px-2 flex gap-2 items-center">
                                        <li class="list-none">{{tag.name}}</li>
                                        <button @click.prevent="removeTag(tag.id)" class="flex items-center hover:text-pink-500"><i class='bx bx-x' ></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <button type="submit" class="w-full bg-pink-500 py-2 px-3 text-slate-200 font-bold">
                                    Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import { Head, Link, router } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { ref, computed } from 'vue';
    import axios from 'axios';

    const clubid = ref(1);
    const title = ref('');
    const description = ref('');
    const ytCode = ref('');
    const tag = ref('');
    const errors = ref([]);
    const searchedTags = ref([]);
    const tags = ref([]);
    const isLoading = ref(false);

    const isValidYtCode = computed(() => {
        if(ytCode.value.length > 7){
            return true
        }else{
            return false;
        }
    })

    const emmbedUrl = computed(() => {
        return `https://www.youtube.com/embed/${ytCode.value}`;
    });

    // function for submit form
    const submitData = () => {
        // console.log(thumbnail.value)
        const tagsID = tags.value.map(tag => {return tag.id});

        axios.post('/activity/store-video', {
            title : title.value,
            description : description.value,
            ytCode : ytCode.value,
            tags : tagsID, //buat ini disimpen ke tabel activity_tag, bisa pakek sync dan deattach, ambil semua id nya saja..
        })
        .then(res => {
            const msg = res.data.message;

            router.visit('/activity', {
                method: 'get',
                data: { message : msg },
            });
            
        }).catch(error => {
            if(error.response && error.response.status === 422){
                errors.value = error.response.data.errors;
            }
            if(error.response.status === 500){
                console.error(error.response);
            }
        })
    }

    // addNew tag
    const addNewtag = async () => {
        if(tag.value === '' || tag.value === null) return;
        
        await axios.post('/tag/store/', {
            'tag' : tag.value,
        }).then(res => {
            const newTag = {"id" : res.data.tag.id, "name" : res.data.tag.name};
            tags.value = [...tags.value, newTag];
            tag.value = '';
        }).catch(err => {
            if(err.response && err.response.status === 422) {
                errors.value = err.response.data.errors;
                setTimeout(() => {
                    errors.value = [];
                    tag.value = '';
                    searchedTags.value = [];
                }, 3000);
            }
        })
        
    }

    // on input event
    const fetchTags = async () => {
        if(tag.value === '') {
            isLoading.value = false;
            searchedTags.value = [];
            return;
        };

        isLoading.value = true;
        await axios.get('/tag/' + tag.value)
            .then(res => {
                searchedTags.value = res.data.data;
            })
            .catch(error => {
                if(error.status == 404){
                    console.log('not found');
                }
            });
        isLoading.value = false;
    }

    // add tag on click
    const addTag = ($tag) => {
        const {id, tag_name} = $tag;
        const data = {"id" : id, "name" : tag_name};

        const isTagExist = tags.value.some((tag) => {
            return tag.id === data.id;
        });

        if(isTagExist){
            tag.value = '';
            searchedTags.value = [];
            return;
        }else{
            tags.value = [...tags.value, data];
            tag.value = '';
            searchedTags.value = [];
        }

    }

    // remove tag when click
    const removeTag = (id) => {
        const index = tags.value.findIndex((tag) => {
            if(tag.id == id) return tag
        });
        tags.value.splice(index, 1);
    }



</script>