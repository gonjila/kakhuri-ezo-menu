<script setup lang="ts">
import { ref, computed } from 'vue';
import { useIntersectionObserver } from '@vueuse/core';
import noImageAvailable from '@/assets/No_Image_Available.png'
import noasd from '@/assets/no-image-available-icon.png'

// Props
const props = defineProps({
    src: { type: String, required: true },
    alt: { type: String, required: true },
    imgClass: {type: String, required: false},
});

// Reactive state
const isVisible = ref(false);
const isLoaded = ref(false);
const imageSrc = ref("");

// Reference to the container (not img)
const imageRef = ref(null);

const computedImageUrl = computed(() => {
    if (props.src.startsWith("http")) return props.src;
    return "/storage/" + props.src;
});

useIntersectionObserver(
    imageRef,
    ([{ isIntersecting }]) => {
        if (isIntersecting) {
            isVisible.value = true;
            imageSrc.value = computedImageUrl.value
        }
    },
    { threshold: 0.1 }
);

const onImageLoad = () => {
    isLoaded.value = true;
};
const onImageError = () => {
    isLoaded.value = true;
    imageSrc.value = noImageAvailable;
}
</script>

<template>
    <div class="lazy-image" ref="imageRef">
        <div v-if="!isLoaded" class="w-full h-full grid place-items-center">
            <div class="loader border-white border-4 border-t-primary"></div>
        </div>

        <img
            v-if="isVisible"
            :src="imageSrc"
            :alt="alt"
            @load="onImageLoad"
            @error="onImageError"
            class="w-full h-full object-cover transition duration-500 hover:scale-110"
            :class="[imgClass, { 'image-loaded': isLoaded }]"
        />
    </div>
</template>

<style scoped>
.lazy-image {
    position: relative;
    width: 100%;
    height: 100%;
}

.loader {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

img {
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.image-loaded {
    opacity: 1;
}
</style>
