<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";
    import {IProduct} from "@/types";
    import {MainLayout} from "@/Layouts";

    defineProps<{products: {data: IProduct[] }}>();
</script>

<template>
    <Head title="All Dishes" />


    <MainLayout>
        {{products.data}}
    </MainLayout>
</template>
