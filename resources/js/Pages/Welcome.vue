<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import {MainLayout, GroupLayout} from "@/Layouts";
import {Mail} from "@/Components/icons";

import {DataType as CategoryDataType} from '@/Components/CategoryItem.vue'
import {DataType as ProductDataType} from "@/Components/ProductItem.vue";

defineProps<{
    categories: CategoryDataType[];
    popular: ProductDataType[]
}>()
</script>

<template>
    <Head title="Welcome" />

    <MainLayout>
        <GroupLayout :title="$t('titles.categories')" type="category" :data="categories">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>

        <GroupLayout :title="$t('titles.popular')" :icon="Mail" type="product" :data="popular">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>

<!--        <GroupLayout :title="$t('titles.combo')" :icon="Mail" type="product" :data="productData">-->
<!--            <template #icon>-->
<!--                <Mail width="44" height="44" />-->
<!--            </template>-->
<!--        </GroupLayout>-->
    </MainLayout>
</template>
