<script setup lang="ts">
    import { computed } from 'vue';

    const props = defineProps<{
        url: string;
        title: string;
        image: string;
    }>();

    const encodedUrl = computed(() => encodeURIComponent(props.url));
    const encodedTitle = computed(() => encodeURIComponent(props.title));
    const encodedImage = computed(() => encodeURIComponent(props.image));

    const shareLinks = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl.value}`,
        twitter: `https://twitter.com/intent/tweet?url=${encodedUrl.value}&text=${encodedTitle.value}`,
        linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl.value}`,
        pinterest: `https://pinterest.com/pin/create/button/?url=${encodedUrl.value}&media=${encodedImage.value}&description=${encodedTitle.value}`
    };
</script>

<template>
    <div class="flex gap-3 flex-wrap">
        <a :href="shareLinks.facebook" target="_blank" class="boxBg boxShadow px-3 py-2">Facebook</a>
        <a :href="shareLinks.twitter" target="_blank" class="boxBg boxShadow  px-3 py-2">Twitter</a>
        <a :href="shareLinks.linkedin" target="_blank" class="boxBg boxShadow  px-3 py-2">LinkedIn</a>
        <a :href="shareLinks.pinterest" target="_blank" class="boxBg boxShadow  px-3 py-2">Pinterest</a>
    </div>
</template>

<style scoped>

</style>
