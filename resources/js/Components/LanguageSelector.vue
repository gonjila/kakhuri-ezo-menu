<template>
    <div ref="selector" class="relative inline-block text-left language-selector ">
        <!-- Current Language Button -->
        <button
            @click="toggleDropdown"
            class="boxBg flex items-center px-4 py-2"
            aria-haspopup="true"
            :aria-expanded="isOpen"
        >
            <span :class="`fi fi-${currentFlag}`"></span>
            <span class="ml-2 capitalize">{{ currentLanguage }}</span>
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
                class="boxBg absolute right-0 mt-2 w-40 shadow-lg z-10"
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
                        <span class="ml-2 capitalize">{{ languageNames[locale] }}</span>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useI18n } from 'vue-i18n';
import "/node_modules/flag-icons/css/flag-icons.min.css";

const { locale, availableLocales } = useI18n();

const isOpen = ref(false);
const selector = ref(null);

const flags = {
    en: 'us',
    ka: 'ge',
};

const languageNames = {
    en: 'English',
    ka: 'Georgian',
};

const currentLanguage = computed(() => {
    return languageNames[locale.value] || locale.value;
});

const currentFlag = computed(() => {
    return flags[locale.value] || 'us';
});

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};

const selectLocale = (selectedLocale) => {
    locale.value = selectedLocale;
    isOpen.value = false;
};

const handleClickOutside = (event) => {
    if (selector.value && !selector.value.contains(event.target)) {
        isOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

