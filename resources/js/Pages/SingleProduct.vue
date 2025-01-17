<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";

    defineProps<{productName: string}>();
</script>

<template>
    <Head title="SingleProduct" />

    {{productName}}
</template>
