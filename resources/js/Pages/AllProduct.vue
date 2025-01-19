<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";
    import {IProduct} from "@/types";
    import {MainLayout} from "@/Layouts";
    import ProductItem from "@/Components/ProductItem.vue";
    import SearchInput from "@/Components/SearchInput.vue";

    defineProps<{products: {data: IProduct[] }}>();
</script>

<template>
    <Head title="All Dishes" />


    <MainLayout>
        <SearchInput/>

        <ul class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-10">
            <ProductItem v-for="item in products.data" :data="item" />
        </ul>
    </MainLayout>
</template>
