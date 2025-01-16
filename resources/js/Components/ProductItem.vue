<script setup lang="ts">
import {computed, ref} from "vue";

export type DataType = {
    id: string;
    name: string;
    slug: string;
    image:string;
    description: string;
    price: number;
    discount: number;
    discounted_price: number;
}

defineProps<{
    data: DataType
}>()

const mouseEntered = ref(false)

const mouseOverHandler = (value: boolean) => {
    mouseEntered.value = value
}

const computedPrice = computed(()=>{})
</script>

<template>
    <li class="relative boxBg boxShadow flex flex-col !overflow-visible">
        <div
            @mouseenter="mouseOverHandler(true)" @mouseleave="mouseOverHandler(false)"
            class="aspect-[4/3] rounded-t-lg overflow-hidden flex items-center justify-center flex-1"
        >
            <img
                :src="data.image"
                :alt="data.name"
                :class="` transition duration-500 ${mouseEntered && 'scale-110'}`"
            >
        </div>

        <div class="pt-4 px-6 pb-8 flex flex-col gap-4 relative">
            <h2 class="blackText text-center text-lg font-bold uppercase">{{data.name}}</h2>
            <p class="line-clamp-3">{{data.description}}</p>

            <div class="py-2 px-10 bg-gray-300 dark:bg-gray-500 rounded-lg flex items-center gap-4 absolute -bottom-7 left-1/2 -translate-x-1/2">
                <div class="flex flex-col items-center">
                    <span class="text-sm line-through grayText">{{data.price}}</span>
                    <span class="text-primary font-bold">{{data.discounted_price}}</span>
                </div>

                <span class="blackText">GEL</span>
            </div>
        </div>
    </li>
</template>
