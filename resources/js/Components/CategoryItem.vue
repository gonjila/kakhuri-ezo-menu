<script setup lang="ts">
    import {Link} from '@inertiajs/vue3'
    import {computed, ref} from "vue";
    import {ICategory} from "@/types";


    const {data} = defineProps<{
        data: ICategory
    }>()

    const mouseEntered = ref(false)

    const mouseOverHandler = (value: boolean) => {
        mouseEntered.value = value
    }

    const imageUrl = computed(() => {
        if(data.image.startsWith("http")){
            return data.image;
        }

        return import.meta.env.BASE_URL + "storage/" + data.image;
    })
</script>
<!--                src="https://bonee.blob.core.windows.net/images/1869aa84-ab63-c4c5-ef95-23d7d07e30d8_3.webp"-->

<template>
    <li class="boxBg boxShadow w-full md:w-[300px] aspect-video md:aspect-square !rounded-[50px] relative overflow-hidden">
        <Link :href="route('all-products', {category_id: data.id})">
            <img
                :src="imageUrl"
                :alt="data.title"
                class="w-full h-full object-cover transition duration-500 hover:scale-110"
            >

            <p class="text-center text-white font-bold uppercase w-full bg-black/50 p-3 absolute left-0 bottom-0 z-10">
                {{data.title}}
            </p>
        </Link>
    </li>
</template>
