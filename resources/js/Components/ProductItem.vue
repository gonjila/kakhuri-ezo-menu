<script setup lang="ts">
    import {Link} from '@inertiajs/vue3';
    import {computed, ref} from "vue";
    import {useI18n} from 'vue-i18n'

    interface ITranslations {
        en: string;
        ka: string;
    }

    export type DataType = {
        id: string;
        name: ITranslations;
        image:string;
        description: ITranslations;
        price: number;
        discount: number;
        discounted_price: number;
    }

    const {data} = defineProps<{
        data: DataType
    }>()

    const i18n = useI18n()
    const isMouseEntered = ref(false)

    const mouseOverHandler = (value: boolean) => {
        isMouseEntered.value = value
    }

    const computedDiscountPrice = computed(()=> {
        if(!data.discount && !data.discounted_price){
            return null
        }else if (data.discount && !data.discounted_price){
            return data.price * data.discount / 100
        }

        return data.discounted_price
    })

    const translatedName = computed(() => {
        return data.name[i18n.locale.value]
    })
    const translatedDescription = computed(() => {
        return data.description[i18n.locale.value]
    })
</script>

<template>
    <li class="relative boxBg boxShadow !overflow-visible cursor-pointer">
        <Link :href="route('product', {productName: translatedName || ''})" class="h-full flex flex-col">
            <div
                @mouseenter="mouseOverHandler(true)" @mouseleave="mouseOverHandler(false)"
                class="aspect-[4/3] rounded-t-lg overflow-hidden flex items-start justify-center flex-1"
            >
                <img
                    :src="data.image"
                    :alt="translatedName"
                    :class="` transition duration-500 ${isMouseEntered && 'scale-110'}`"
                >
            </div>

            <div class="pt-4 px-6 pb-8 flex flex-col gap-4 relative">
                <h2 class="blackText text-center text-lg font-bold uppercase">{{translatedName}}</h2>
                <p class="line-clamp-3">{{translatedDescription}}</p>

                <div class="py-1 lg:py-2 px-5 lg:px-10 bg-gray-300 dark:bg-gray-500 rounded-lg flex items-center gap-3 absolute -bottom-5 left-1/2 -translate-x-1/2">
                    <div class="flex gap-2 items-center">
                        <span :class="computedDiscountPrice ? 'text-sm line-through grayText':'text-primary font-bold'">{{data.price}}</span>
                        <span v-if="computedDiscountPrice" class="text-primary font-bold">{{computedDiscountPrice}}</span>
                    </div>

                    <span class="blackText">GEL</span>
                </div>
            </div>

            <div
                v-if="data.discount"
                class="text-white font-bold h-7 bg-primary px-5 rounded-r-lg absolute top-[30px] left-0 before:block before:w-2 before:h-[110%] before:bg-primary before:absolute before:right-full before:rounded-l-lg"
            >
                -{{data.discount}}%
            </div>
        </Link>
    </li>
</template>
