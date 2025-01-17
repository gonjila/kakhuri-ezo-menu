<template>
    <button
        @click="toggleTheme"
        class="boxBg flex items-center px-2.5"
        :aria-label="isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
    >
        <span v-if="isDark">
            🌙
<!--            <span class="ml-2">Light Mode</span>-->
        </span>
        <span v-else>
            ☀️
<!--            <span class="ml-2">Dark Mode</span>-->
        </span>
    </button>
</template>

<script setup lang="ts">
import { useTheme } from '@/Composables/useTheme'

const { isDark, toggleTheme } = useTheme()
</script>
