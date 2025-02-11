<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";
    import {ICategory} from "@/types";
    import {MainLayout} from "@/Layouts";
    import SearchInput from "@/Components/SearchInput.vue";
    import ProductItem from "@/Components/ProductItem.vue";
    import {useI18n} from "vue-i18n";

    defineProps<{
        categories: {data: ICategory[]}
    }>();
</script>

<template>
    <Head title="All Dishes" />

    <MainLayout>
        <SearchInput :is-shown-all-products-btn="false"/>

        <div v-for="category in categories.data" :key="category.id">
            <div v-if="category?.products?.length > 0" class="flex flex-col justify-center gap-7">
                <h2 class="blackText lg sm:text-xl lg:text-2xl uppercase">{{category.title}}</h2>

                <ul class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-10">
                    <ProductItem v-for="item in category.products" :data="item" />
                </ul>
            </div>
        </div>

        <div v-if="categories?.data?.length === 0" class="blackText text-2xl uppercase flex justify-center">{{$t('noData')}}</div>
    </MainLayout>
</template>
