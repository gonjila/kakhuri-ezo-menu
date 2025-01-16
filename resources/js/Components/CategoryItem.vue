<script setup lang="ts">
    import {ref} from "vue";

    export type DataType = {id: string, name: string, slug: string}

    defineProps<{
        data: DataType
    }>()

    const mouseEntered = ref(false)

    const mouseHandler = (value: boolean) => {
        mouseEntered.value = value
    }
</script>

<template>
    <li
        @mouseover="mouseHandler(true)" @mouseleave="mouseHandler(false)"
        class="w-[300px] h-[300px] rounded-[50px] border border-gray-500 relative overflow-hidden boxShadow"
    >
        <a :href="data.slug">
            <img
                src="https://bonee.blob.core.windows.net/images/1869aa84-ab63-c4c5-ef95-23d7d07e30d8_3.webp"
                :alt="data.name"
                :class="`absolute inset-0 transition duration-500 ${mouseEntered && 'scale-110'}`"
            >

            <p class="text-center text-white font-bold uppercase w-full bg-black/50 py-3 absolute left-0 bottom-0 z-10">
                {{data.name}}
            </p>
        </a>
    </li>
</template>
