<script setup lang="ts">
    import {Link} from '@inertiajs/vue3'
    import {computed} from "vue";
    import {ICategory} from "@/types";
    import LazyImage from "@/Components/LazyImage.vue";


    const {data} = defineProps<{
        data: ICategory
    }>()
</script>

<template>
    <li class=" boxShadow w-full md:w-[300px] aspect-video md:aspect-square !rounded-[50px] relative overflow-hidden">
        <Link :href="route('all-products', {category_id: data.id})">
            <LazyImage :src="data.image" :alt="data.title" imgClass="w-1/2" />

            <p class="text-center text-white font-bold uppercase w-full bg-black/50 py-3 px-4 absolute left-0 bottom-0 z-10">
                {{data.title}}
            </p>
        </Link>
    </li>
</template>
