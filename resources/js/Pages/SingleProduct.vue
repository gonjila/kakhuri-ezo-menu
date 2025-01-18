<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";

    defineProps<{product: object}>();
</script>

<template>
    <Head title="SingleProduct" />

    {{product}}
</template>
