<script setup lang="ts">
    defineProps<{
        discount: number;
    }>()
</script>

<template>
    <div
        v-if="discount"
        class="text-white font-bold h-7 bg-primary px-5 rounded-r-lg absolute top-[30px] left-0 before:block before:w-2 before:h-[110%] before:bg-primary before:absolute before:right-full before:rounded-l-lg"
    >
        -{{discount}}%
    </div>
</template>
