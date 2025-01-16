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

const {data} = defineProps<{
    data: DataType
}>()

const mouseEntered = ref(false)

const mouseOverHandler = (value: boolean) => {
    mouseEntered.value = value
}

const computedDiscountPrice = computed(()=> {
    if(!data.discount && !data.discounted_price){
        return null
    }else if (data.discount && !data.discounted_price){
        return data.price * data.discount / 100
    }

    return data.discounted_price
})
</script>

<template>
    <li class="relative boxBg boxShadow flex flex-col !overflow-visible">
        <div
            @mouseenter="mouseOverHandler(true)" @mouseleave="mouseOverHandler(false)"
            class="aspect-[4/3] rounded-t-lg overflow-hidden flex items-start justify-center flex-1"
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

            <div class="py-1 lg:py-2 px-5 lg:px-10 bg-gray-300 dark:bg-gray-500 rounded-lg flex items-center gap-3 absolute -bottom-5 left-1/2 -translate-x-1/2">
                <div class="flex gap-2 items-center">
                    <span :class="computedDiscountPrice ? 'text-sm line-through grayText':'text-primary font-bold'">{{data.price}}</span>
                    <span v-if="computedDiscountPrice" class="text-primary font-bold">{{computedDiscountPrice}}</span>
                </div>

                <span class="blackText">GEL</span>
            </div>
        </div>
    </li>
</template>
