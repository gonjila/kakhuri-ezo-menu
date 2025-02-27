<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useI18n } from 'vue-i18n';
import "/node_modules/flag-icons/css/flag-icons.min.css";
import {router} from "@inertiajs/vue3";

const { locale, availableLocales } = useI18n();

const isOpen = ref(false);
const selector = ref<HTMLElement | null>(null);
const LANGUAGE_NAME = "lang";

const flags: Record<string, string> = {
    en: 'us',
    ka: 'ge',
};

const languageNames: Record<string, string> = {
    en: 'English',
    ka: 'ქართული',
};

const currentLanguage = computed<string>(() => {
    return languageNames[locale.value] || locale.value;
});

const currentFlag = computed<string>(() => {
    return flags[locale.value] || 'us';
});

const toggleDropdown = (): void => {
    isOpen.value = !isOpen.value;
};

const selectLocale = (selectedLocale: string): void => {
    locale.value = selectedLocale;
    isOpen.value = false;

    localStorage.setItem(LANGUAGE_NAME, selectedLocale)

    router.post(`/set-language`, {lang: selectedLocale})
};

const handleClickOutside = (event: MouseEvent): void => {
    if (selector.value && !selector.value?.contains(event.target as Node)) {
        isOpen.value = false;
    }
};

onMounted(() => {
    const savedLang = localStorage.getItem(LANGUAGE_NAME);
    if (savedLang) {
        locale.value = savedLang;
    }

    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div ref="selector" class="relative inline-block text-left language-selector ">
        <!-- Current Language Button -->
        <button
            @click="toggleDropdown"
            class="boxBg flex items-center px-4 py-2"
            aria-haspopup="true"
            :aria-expanded="isOpen"
            aria-label="language selector"
        >
            <span :class="`fi fi-${currentFlag}`"></span>
            <span class="hidden lg:block ml-2 capitalize">{{ currentLanguage }}</span>
            <svg
                class="w-4 h-4 ml-2"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />
            </svg>
        </button>

        <!-- Dropdown Menu with Transition -->
        <transition name="fade">
            <div
                v-if="isOpen"
                class="boxBg absolute right-0 mt-2 min-w-full shadow-lg z-10"
                role="menu"
                aria-orientation="vertical"
                aria-label="Language selector"
            >
                <ul>
                    <li
                        v-for="locale in availableLocales"
                        :key="locale"
                        @click="selectLocale(locale)"
                        class="flex items-center px-4 py-2 hover:bg-gray-100/20 cursor-pointer"
                        role="menuitem"
                        tabindex="0"
                        @keydown.enter="selectLocale(locale)"
                        @keydown.space.prevent="selectLocale(locale)"
                    >
                        <span :class="`fi fi-${flags[locale]}`"></span>
                        <span class="hidden lg:block ml-2 capitalize">{{ languageNames[locale] }}</span>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>
