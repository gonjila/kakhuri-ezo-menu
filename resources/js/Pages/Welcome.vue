<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import {MainLayout, GroupLayout} from "@/Layouts";
import {Mail} from "@/Components/icons";

import {ICategory, IProduct} from "@/types";
import SearchInput from "@/Components/SearchInput.vue";

defineProps<{
    categories: {data: ICategory[]};
    popular: {data: IProduct[]};
}>()
</script>

<template>
    <Head title="Welcome" />

    <MainLayout>
        <SearchInput />

        <GroupLayout v-if="categories.data.length > 0" :title="$t('titles.categories')" type="category" :data="categories.data">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>

        <GroupLayout v-if="popular.data.length > 0" :title="$t('titles.popular')" :icon="Mail" type="product" :data="popular.data">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>
    </MainLayout>
</template>
