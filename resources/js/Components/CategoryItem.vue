<script setup lang="ts">
    import {Link} from '@inertiajs/vue3'
    import {computed, ref} from "vue";
    import {useI18n} from "vue-i18n";

    export type DataType = {id: string, title: string}

    const {data} = defineProps<{
        data: DataType
    }>()

    const i18n = useI18n()
    const mouseEntered = ref(false)

    const mouseOverHandler = (value: boolean) => {
        mouseEntered.value = value
    }

    const translatedName = computed(() => {
        return data.title[i18n.locale.value]
    })
</script>

<template>
    <li
        @mouseenter="mouseOverHandler(true)" @mouseleave="mouseOverHandler(false)"
        class="boxBg boxShadow w-full md:w-[300px] aspect-video md:aspect-square !rounded-[50px] relative overflow-hidden"
    >
        <Link :href="route('all-products')">
            <img
                src="https://bonee.blob.core.windows.net/images/1869aa84-ab63-c4c5-ef95-23d7d07e30d8_3.webp"
                :alt="translatedName"
                :class="`absolute inset-0 transition duration-500 ${mouseEntered && 'scale-110'}`"
            >

            <p class="text-center text-white font-bold uppercase w-full bg-black/50 p-3 absolute left-0 bottom-0 z-10">
                {{translatedName}}
            </p>
        </Link>
    </li>
</template>
