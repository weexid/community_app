<script setup>
    import { Head, useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { ref } from 'vue';
    import { onMounted } from 'vue';


    const props = defineProps({
        'club': Object
    });

    const form = useForm({
        club_title: props.club.club_title,
        club_tagline: props.club.club_tagline,
        description: props.club.description,
        image: props.club.image,
        image_url: props.club.image_url,
    })

    const isImageUrl = ref(false);

    onMounted(() => {
        if(props.club.image_url){
            isImageUrl.value = true;
        }else{
            isImageUrl.value = false;
        }
    })
    
</script>

<template>
    <Head title="Edit Club"/>
    <AppLayout>
        <div class="bg-white max-w-[1300px] mx-auto">
            <div class="p-2">
                <h1 class="text-bold text-4xl text-center py-5 text-pink-500">Edit Club</h1>
                <div class="p-2 border w-1/2 mx-auto">
                    <form @submit.prevent="form.post('/club/update/' + props.club.slug)">
                        <div class="pb-2">
                            <label for="club_title">Club Title</label>
                            <input v-model="form.club_title" class="w-full" type="text" id="club_title" name="club_title">
                        </div>
                        <div class="pb-2">
                            <label for="club_tagline">Club tagline</label>
                            <input v-model="form.club_tagline" class="w-full" type="text" id="club_tagline" name="club_tagline">
                        </div>
                        <div class="pb-2">
                            <label for="desc">Club description</label> <br/>
                            <textarea v-model="form.description" class="w-full" name="description" id="desc" cols="30" rows="3"></textarea>
                        </div>
                        <div class="pb-2">
                            <label for="club_image">Club image</label>
                            <div>
                                <p>(current img)</p>
                                <img class="pb-2" :src="props.club.image ? '/storage/images/' + props.club.image : props.club.image_url" alt="club_foto" width="128">
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
                                <input v-if="!isImageUrl" type="file" class="w-full" name="image">
                                <input v-model="form.image_url" v-if="isImageUrl" type="text" class="w-full" name="image_url" placeholder="your image url">
                            </div>
                        </div>

                        <div class="pb-2">
                            <button class="py-2 px-5 bg-slate-500 text-white">Update</button>
                        </div>
                        <div class="pb-2">
                            <label>Club Carousels</label>
                            <div v-for="item in props.club.carousel"> 
                                <img :src="item.image ? '/storage/images/'+ item.image : item.image_url " :alt="item.id">
                                <a href="#">Delete</a>
                                <a href="#">Edit</a>
                            </div>
                        </div>
                    </form>
                </div>
                {{ props.club }}
            </div>
        </div>
    </AppLayout>
</template>