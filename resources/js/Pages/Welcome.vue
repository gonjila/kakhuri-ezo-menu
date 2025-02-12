<script setup lang="ts">
    import {Head} from '@inertiajs/vue3';
    import {MainLayout, GroupLayout} from "@/Layouts";
    import {Categories, Discount, FavoritesStar, Mail} from "@/Components/icons";

    import {ICategory, IProduct} from "@/types";
    import SearchInput from "@/Components/SearchInput.vue";

    defineProps<{
        categories: {data: ICategory[]};
        popular: {data: IProduct[]};
        discounted: {data: IProduct[]};
    }>()
</script>

<template>
    <Head>
        <title>Welcome</title>
        <meta name="description" content="Your page description">
    </Head>

    <MainLayout>
        <SearchInput />

        <GroupLayout v-if="categories.data.length > 0" :title="$t('titles.categories')" type="category" :data="categories.data">
            <template #icon>
                <Categories width="44" height="44" />
            </template>
        </GroupLayout>

        <GroupLayout v-if="popular.data.length > 0" :title="$t('titles.popular')" :icon="Mail" type="product" :data="popular.data">
            <template #icon>
                <FavoritesStar width="44" height="44" />
            </template>
        </GroupLayout>

        <GroupLayout v-if="popular.data.length > 0" :title="$t('titles.discounted')" :icon="Mail" type="product" :data="discounted.data">
            <template #icon>
                <Discount width="44" height="44" />
            </template>
        </GroupLayout>
    </MainLayout>
</template>
