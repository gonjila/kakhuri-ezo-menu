<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import {MainLayout, GroupLayout} from "@/Layouts";
import {Mail} from "@/Components/icons";

const categoryData = [{id:"0", name:"burger"}, {id:"1",name:"combo"}, {id:"2",name:"souce"}, {id:"3",name:"drinks"}]

const productData = [
    {id:"0", name:"Obelix (+)", image:"https://bonee.blob.core.windows.net/images/a30bc6cf-905b-a34b-b70a-6aaee0b97dc6_2.webp", description:"bread within meat and lot of cheese. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur doloremque eligendi ipsa omnis, vel vero.", price:25},
    {id:"0", name:"5 Cheese burger", image:"https://bonee.blob.core.windows.net/images/a30bc6cf-905b-a34b-b70a-6aaee0b97dc6_2.webp", description:"bread within meat and lot of cheese. Lorem ipsum dolor sit amet.", price:100, discount: 10, discounted_price:22.5},
    {id:"0", name:"Jalapeno Burger", image:"https://bonee.blob.core.windows.net/images/1869aa84-ab63-c4c5-ef95-23d7d07e30d8_3.webp", description:"bread within meat and lot of cheese", price:25},
    {id:"0", name:"Jalapeno Burger Combo", image:"https://bonee.blob.core.windows.net/images/1869aa84-ab63-c4c5-ef95-23d7d07e30d8_3.webp", description:"bread within meat and lot of cheese. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur doloremque eligendi ipsa omnis, vel vero.", price:25, discount: 10, discounted_price:22.5},
    {id:"0", name:"White Lion Combo", image:"https://bonee.blob.core.windows.net/images/1869aa84-ab63-c4c5-ef95-23d7d07e30d8_3.webp", description:"bread within meat and lot of cheese", price:25, discount: 10, discounted_price:22.5},
]
</script>

<template>
    <Head title="Welcome" />

    <MainLayout>
        <GroupLayout :title="$t('titles.categories')" type="category" :data="categoryData">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>

        <GroupLayout :title="$t('titles.popular')" :icon="Mail" type="product" :data="productData">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>

        <GroupLayout :title="$t('titles.combo')" :icon="Mail" type="product" :data="productData">
            <template #icon>
                <Mail width="44" height="44" />
            </template>
        </GroupLayout>
    </MainLayout>
</template>
