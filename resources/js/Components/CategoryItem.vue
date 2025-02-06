<script setup lang="ts">
    import {Link} from '@inertiajs/vue3'
    import {computed} from "vue";
    import {ICategory} from "@/types";


    const {data} = defineProps<{
        data: ICategory
    }>()

    const imageUrl = computed(() => {
        if(data.image.startsWith("http")){
            return data.image;
        }

        return "/storage/" + data.image;
    })
</script>

<template>
    <li class=" boxShadow w-full md:w-[300px] aspect-video md:aspect-square !rounded-[50px] relative overflow-hidden">
        <Link :href="route('all-products', {category_id: data.id})">
            <img
                :src="imageUrl"
                :alt="data.title"
                class="w-full h-full object-cover transition duration-500 hover:scale-110"
            >

            <p class="text-center text-white font-bold uppercase w-full bg-black/50 py-3 px-4 absolute left-0 bottom-0 z-10">
                {{data.title}}
            </p>
        </Link>
    </li>
</template>
