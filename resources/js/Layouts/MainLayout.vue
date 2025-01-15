<script setup lang="ts">
import LanguageSelector from "@/Components/LanguageSelector.vue";
import ThemeToggleButton from "@/Components/ThemeToggleButton.vue";
import {Location, Mail, Phone, Facebook, Logo} from "@/Components/icons";

defineProps<{canLogin?: boolean}>();
</script>

<template>
    <div class="grayText relative min-h-screen bg-gray-50 dark:bg-black">
        <div class="relative w-full container px-6 mx-auto">
            <header
                class="max-w-full grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
            >
                <div class="flex lg:col-start-2 lg:justify-center">
                    <Logo/>
                </div>

                <div v-if="canLogin" class="flex flex-1 justify-end gap-3">
<!--                    <Link-->
<!--                        v-if="$page.props.auth.user"-->
<!--                        :href="route('dashboard')"-->
<!--                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"-->
<!--                    >-->
<!--                        Dashboard-->
<!--                    </Link>-->
<!--                        <template v-else>-->
<!--                            <Link-->
<!--                                :href="route('login')"-->
<!--                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"-->
<!--                            >-->
<!--                                {{ $t('auth.login') }}-->
<!--                            </Link>-->

<!--                            <Link-->
<!--                                v-if="canRegister"-->
<!--                                :href="route('register')"-->
<!--                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"-->
<!--                            >-->
<!--                                {{ $t('auth.register') }}-->
<!--                            </Link>-->
<!--                        </template>-->

                    <LanguageSelector />

                    <ThemeToggleButton/>
                </div>
            </header>

            <slot />

            <footer
                class="pt-16 pb-3 text-sm text-black dark:text-white/70 flex flex-col gap-4"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <a href="https://maps.app.goo.gl/41pSe9nroqQFsghf9" target="_blank" class="flex items-center gap-2">
                            <Location/> <span>78a Vazha-Pshavela Ave, T'bilisi, Georgia</span>
                        </a>
                        <a href="tel:8882192787" class="flex items-center gap-2"><Phone/> <span>555 555 555</span></a>
                        <a href="mailto:example@google.com" class="flex items-center gap-2"><Mail/> <span>example@mail.com</span></a>
                    </div>

                    <a href="https://www.facebook.com/restaurantkakhuriezo" target="_blank" class="w-9 h-9 bg-blue-400 rounded-full flex items-center justify-center"><facebook/></a>
                </div>

                <hr class="border-gray-500">

                <div class="text-center">made by <a href="https://portfolio-gonjila.vercel.app/" target="_blank" class="text-primary">GONJILA</a></div>
            </footer>
        </div>
    </div>
</template>
