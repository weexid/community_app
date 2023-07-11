<script setup>
    import { Head, router, useForm, usePage } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { ref } from 'vue';
    import { onMounted } from 'vue';
import { computed } from 'vue';


    const {club} = defineProps({
        'club': Object
    });

    const form = useForm({
        club_title: club.club_title,
        club_tagline: club.club_tagline,
        description: club.description,
        image: null,
        image_url: null,
    })

    const isImageUrl = ref(false);

    onMounted(() => {
        if(club.image_url){
            isImageUrl.value = true;
        }else{
            isImageUrl.value = false;
        }
    }) 

    function submit($slug) {
        router.post(`/club/update/${$slug}`, {
            _method: 'put',
            club_title : form.club_title,
            club_tagline : form.club_tagline,
            description : form.description,
            image : form.image,
            image_url : form.image_url,
        });
    }

    const errors = computed(() => usePage().props.errors);
    
</script>

<template>
    <Head title="Edit Club"/>
    <AppLayout>
        <div class="bg-white max-w-[1300px] mx-auto">
            <div class="p-2">
                <h1 class="text-bold text-4xl text-center py-5 text-pink-500">Edit Club</h1>
                <div class="p-2 border w-1/2 mx-auto">
                    <div v-if="Object.keys(errors) !== 0">
                        <div v-for="error in errors">
                            {{ error }}
                        </div>
                    </div>

                    <!-- {{ $page.props.errors }} -->
                    <form method="post" @submit.prevent="submit(club.slug)" enctype="multipart/form-data">
                        <div class="pb-2">
                            <label for="club_title">Club Title</label>
                            <input v-model="form.club_title" class="w-full" type="text" id="club_title" name="club_title">
                            <div class="text-sm text-red-500" v-if="errors.club_title">{{ errors.club_title }}</div>
                        </div>
                        <div class="pb-2">
                            <label for="club_tagline">Club tagline</label>
                            <input v-model="form.club_tagline" class="w-full" type="text" id="club_tagline" name="club_tagline">
                            <div class="text-sm text-red-500" v-if="errors.club_tagline">{{ errors.club_tagline }}</div>
                        </div>
                        <div class="pb-2">
                            <label for="desc">Club description</label> <br/>
                            <textarea v-model="form.description" class="w-full" name="description" id="desc" cols="30" rows="3"></textarea>
                            <div class="text-sm text-red-500" v-if="errors.description">{{ errors.description }}</div>
                        </div>
                        <div class="pb-2">
                            <label for="club_image">Club image</label>
                            <div>
                                <p>(current img)</p>
                                <img class="pb-2" :src="club.image ? '/storage/images/' + club.image : club.image_url" alt="club_foto" width="128">
                            </div>
                            <div>
                                <button 
                                class="p-2" 
                                :class="{'bg-slate-200' : !isImageUrl}"
                                @click.prevent="isImageUrl = false">
                                    Upload from pc
                                </button>
                                <button 
                                class="p-2"
                                :class="{ 'bg-slate-200': isImageUrl }"
                                @click.prevent="isImageUrl = true">
                                    Upload from url
                                </button>
                            </div>
                            <div class="py-4">
                                <input v-if="!isImageUrl" @input="form.image = $event.target.files[0]" type="file" class="w-full" name="image">
                                <div class="text-sm text-red-500" v-if="errors.image">
                                    {{ errors.image }}
                                </div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>

                                <input v-model="form.image_url" v-if="isImageUrl" type="text" class="w-full" name="image_url" placeholder="your image url">
                                <div v-if="errors.image_url">{{ errors.image_url }}</div>

                                <br>
                            </div>
                        </div>

                        <div class="pb-2">
                            <button class="py-2 px-5 bg-slate-500 text-white">Update</button>
                        </div>

                        <div v-if="club.carousel.length > 0" class="pb-2">
                            <label>Club Carousels</label>
                            <div v-for="item in club.carousel"> 
                                <img :src="item.image ? '/storage/images/'+ item.image : item.image_url " :alt="item.id">
                                <a href="#">Delete</a>
                                <a href="#">Edit</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>