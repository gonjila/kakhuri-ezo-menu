<script setup lang="ts">
export type DataType = {id: string, name: string, slug: string}

defineProps<{
    data: DataType
}>()
</script>

<template>
    Product Item
</template>
