<template>
    <Head title="Create Club" />
    <AppLayout >
        <div class="bg-white max-w-[1300px] mx-auto">
            <div class="py-5">
                <h1 class="text-4xl text-center font-bold text-slate-700">Create new club</h1>
                <div class="mt-5 p-5 border w-1/2 mx-auto">
                    <form action="post" @submit.prevent="form.post('/club/store')" enctype="multipart/form-data">
                        <div class="pb-2">
                            <label for="club_title">Club Title</label>
                            <input v-model="form.club_title" class="w-full" type="text" id="club_title" name="club_title">
                            <div class="text-sm text-red-500" v-if="form.errors.club_title">{{ form.errors.club_title }}</div>
                        </div>
                        <div class="pb-2">
                            <label for="club_tagline">Club tagline</label>
                            <input v-model="form.club_tagline" class="w-full" type="text" id="club_tagline" name="club_tagline">
                            <div class="text-sm text-red-500" v-if="form.errors.club_tagline">{{ form.errors.club_tagline }}</div>
                        </div>
                        <div class="pb-2">
                            <label for="desc">Club description</label> <br/>
                            <textarea v-model="form.description" class="w-full" name="description" id="desc" cols="30" rows="3"></textarea>
                            <div class="text-sm text-red-500" v-if="form.errors.description">{{ form.errors.description }}</div>
                        </div>
                        <div class="pb-2">
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
                                <div class="text-sm text-red-500" v-if="form.errors.image">
                                    {{ form.errors.image }}
                                </div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>

                                <input v-model="form.image_url" v-if="isImageUrl" type="text" class="w-full" name="image_url" placeholder="your image url">
                                <div v-if="form.errors.image_url">{{ form.errors.image_url }}</div>

                                <br>
                            </div>
                        </div>

                        <div class="pb-2">
                            <button type="submit" class="py-2 px-5 bg-slate-500 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import {Head, router, useForm} from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { ref } from 'vue';

    const isImageUrl = ref(false);

    const form = useForm({
        club_title: null,
        club_tagline: null,
        description: null,
        image: null,
        image_url: null,
    })

</script>