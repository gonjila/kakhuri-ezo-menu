<script setup lang="ts">
import CategoryItem from "@/Components/CategoryItem.vue";
 import ProductItem from "@/Components/ProductItem.vue";
import {ICategory, IProduct} from "@/types";

 defineProps<{
     title: string
     type: "category" | "product"
     data: (ICategory | IProduct)[]
 }>()
</script>

<template>
    <section class="flex flex-col gap-7">
        <h2 class="blackText text-xl sm:text-2xl lg:text-3xl uppercase flex items-center gap-3">
            <slot name="icon"/> <span>{{title}}</span>
        </h2>

        <ul v-if="type==='category'" class="w-full flex flex-wrap items-center justify-center gap-10">
            <CategoryItem v-for="item in (data as ICategory[])" :data="item" />
        </ul>

        <ul v-if="type==='product'" class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-10">
            <ProductItem v-for="item in (data as IProduct[])" :data="item" />
        </ul>
    </section>
</template>

