<style scoped>
    .text-editor{
        min-height: 250px;
    }
</style>
<template>
    <div class="flex gap-5">
        <div class="w-[75%] h-[auto]">
            <h1 class="text-center text-4xl">{{ activity.title }}</h1>
            <div class="w-full">
                <img class="w-1/2 mx-auto mt-5" :src="'/storage/images/' + activity.thumbnail" alt="">
            </div>
            
            <div v-if="htmlData" class="ql-editor" style="height: auto;" v-html="htmlData"></div>
            <div v-else class="p-5 text-center text-2xl text-slate-600">
                There is no content to show
            </div>
            <!-- <div>{{ activity }}</div> -->
            <div>
            </div>
        </div>

        <div class="w-[25%]">
            <PostSidebar>
                <div class="mb-5">
                    <h2 class="text-2xl mb-3">Related Article</h2>
                    <!-- {{ relatedActivity }} -->
                    <div class="mb-2 px-5 border py-3" v-for="item in relatedActivity" :key="item.id">
                        <h2 class="text-md font-semibold">{{ item.title }}</h2>
                        <p>{{item.description}}</p>
                        <div class="w-full text-right text-sm text-pink-500">
                            {{ item.club.club_title }}
                        </div>
                    </div>
                </div>
            </PostSidebar>
        </div>
    </div>
</template>

<script setup>
    import PostSidebar from '@/Components/PostSidebar.vue';
    import { onMounted, ref } from 'vue';
    import {QuillDeltaToHtmlConverter} from 'quill-delta-to-html';
    import '@vueup/vue-quill/dist/vue-quill.snow.css';
    const {activity, relatedActivity} = defineProps(['activity', 'relatedActivity']);

    const deltaData = ref(null);
    const htmlData = ref(null);

    onMounted(() => {
        if(activity.type == 'article' && activity.article.length !== 0){
            if(activity.article[0].content !== null){
                deltaData.value = JSON.parse(activity.article[0].content);
                if(deltaData.value !== null){
                    const converter = new QuillDeltaToHtmlConverter(deltaData.value.ops, {
                        inlineStyles: {
                            font: {
                                'serif': 'font-family: Georgia, Times New Roman, serif',
                                'monospace': 'font-family: Monaco, Courier New, monospace'
                            },
                            size: {
                                'small': 'font-size: 0.75em',
                                'large': 'font-size: 1.5em',
                                'huge': 'font-size: 2.5em'
                            },
                            indent: (value, op) => {
                                var indentSize = parseInt(value, 10) * 3;
                                var side = op.attributes['direction'] === 'rtl' ? 'right' : 'left';
                                return 'padding-' + side + ':' + indentSize + 'em';
                            },
                            direction: (value, op) => {
                                if (value === 'rtl') {
                                    return 'direction:rtl' + ( op.attributes['align'] ? '' : '; text-align: inherit' );
                                } else {
                                    return '';
                                }
                            }
                        },
                    });
                    htmlData.value = converter.convert();
                }
                
            }

        }
    });
</script>

<style scoped>
.rich-text-display{
    height: auto;
}
</style>