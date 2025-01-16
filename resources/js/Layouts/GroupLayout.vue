<script setup lang="ts">
import CategoryItem, {DataType as CategoryDataType} from "@/Components/CategoryItem.vue";
 import ProductItem, {DataType as ProductDataType} from "@/Components/ProductItem.vue";

 defineProps<{
     title: string
     type: "category" | "product"
     data: (CategoryDataType | ProductDataType)[]
 }>()
</script>

<template>
    <div class="flex flex-col gap-7">
        <h2 class="blackText text-3xl font-bold uppercase flex items-center gap-3">
            <slot name="icon"/> <span class="">{{title}}</span>
        </h2>

        <div class="flex">
            <ul v-if="type==='category'" class="w-full flex items-center justify-center gap-10">
                <CategoryItem v-for="item in data" :data="item" />
            </ul>

            <ul v-if="type==='product'" class="w-full flex items-center gap-10">
                <ProductItem v-for="item in data" :data="item" />
            </ul>
        </div>
    </div>
</template>

