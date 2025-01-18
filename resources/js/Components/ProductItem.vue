<script setup lang="ts">
    import {Link} from '@inertiajs/vue3';
    import {ref} from "vue";
    import {IProduct} from "@/types";
    import DiscountBadge from "@/Components/DiscountBadge.vue";

    const {data} = defineProps<{
        data: IProduct
    }>()

    const isMouseEntered = ref(false)

    const mouseOverHandler = (value: boolean) => {
        isMouseEntered.value = value
    }
</script>

<template>
    <li class="relative boxBg boxShadow !overflow-visible cursor-pointer">
        <Link :href="route('product', {productId: data.id})" class="h-full flex flex-col">
            <div
                @mouseenter="mouseOverHandler(true)" @mouseleave="mouseOverHandler(false)"
                class="aspect-[4/3] rounded-t-lg overflow-hidden flex items-start justify-center flex-1"
            >
                <img
                    :src="data.image"
                    :alt="data.name"
                    :class="` transition duration-500 ${isMouseEntered && 'scale-110'}`"
                >
            </div>

            <div class="pt-4 px-6 pb-8 flex flex-col gap-4 relative">
                <h2 class="blackText text-center text-lg font-bold uppercase">{{data.name}}</h2>
                <p class="line-clamp-3">{{data.description}}</p>

                <div class="py-1 lg:py-2 px-5 lg:px-10 bg-gray-300 dark:bg-gray-500 rounded-lg flex items-center gap-3 absolute -bottom-5 left-1/2 -translate-x-1/2">
                    <div class="flex gap-2 items-center">
                        <span :class="data.discounted_price ? 'text-sm line-through grayText':'text-primary font-bold'">{{data.price}}</span>
                        <span v-if="data.discounted_price" class="text-primary font-bold">{{data.discounted_price}}</span>
                    </div>

                    <span class="blackText">GEL</span>
                </div>
            </div>

            <DiscountBadge :discount="data.discount" />
        </Link>
    </li>
</template>
