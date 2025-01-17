<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";

    defineProps<{categoryName: string}>();
</script>

<template>
    <Head title="All Dishes" />
    all dishes {{categoryName}}
</template>
