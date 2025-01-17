import { ref, onMounted, watch } from 'vue'

type Theme = 'light' | 'dark'

export function useTheme() {
    const isDark = ref<boolean>(false)

    // Function to apply the theme by adding/removing the 'dark' class
    const applyTheme = (dark: boolean): void => {
        const root = document.documentElement
        if (dark) {
            root.classList.add('dark')
        } else {
            root.classList.remove('dark')
        }
    }

    // Initialize theme on mount
    onMounted(() => {
        // Check for saved user preference
        const savedTheme = localStorage.getItem('theme') as Theme | null
        if (savedTheme) {
            isDark.value = savedTheme === 'dark'
        } else {
            // If no saved preference, use system preference
            isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches
        }
        applyTheme(isDark.value)
    })

    // Watch for changes and apply the theme
    watch(isDark, (newVal: boolean) => {
        applyTheme(newVal)
        localStorage.setItem('theme', newVal ? 'dark' : 'light')
    })

    // Toggle function
    const toggleTheme = (): void => {
        isDark.value = !isDark.value
    }

    return { isDark, toggleTheme }
}
