<template>
    <h1>Hello update</h1>
    {{ activity }}
</template>
<script setup>
    const {activity} = defineProps(['activity']);
</script>
