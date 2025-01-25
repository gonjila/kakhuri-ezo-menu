<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import LanguageSelector from "@/Components/LanguageSelector.vue";
import ThemeToggleButton from "@/Components/ThemeToggleButton.vue";
import {Location, Mail, Phone, Facebook, Logo, Instagram, Tiktok} from "@/Components/icons";
</script>

<template>
    <div class="grayText relative min-h-screen bg-gray-50 dark:bg-black/85">
        <div class="min-h-screen relative w-full container px-6 mx-auto flex flex-col">
            <header
                class="max-w-full grid grid-cols-2 lg:grid-cols-3 items-center gap-2 py-10"
            >
                <Link href="/" class="flex lg:col-start-2 lg:justify-center items-center gap-3">
                    <Logo/>

                    <div class="hidden sm:flex flex-col">
                        <h2 class="text-lg">{{$t('welcome.part1')}}</h2>
                        <h1 class="text-primary text-xl uppercase">{{$t('welcome.part2')}}</h1>
                    </div>
                </Link>

                <div class="col-start-2 lg:col-start-3 flex flex-1 justify-end gap-3">
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

            <main class="flex-1 flex flex-col gap-20">
                <slot />
            </main>

            <footer
                class="blackText text-sm pb-3 mt-16 flex flex-col gap-4"
            >
                <div class="flex items-center justify-between gap-5">
                    <div class="flex flex-col md:flex-row md:items-center gap-3 lg:gap-6">
                        <a href="https://maps.app.goo.gl/QrjQvAjbgafKDCRU8" target="_blank" class="min-w-max flex items-center gap-2">
                            <Location/> <span>88 აწყურის ქუჩა, თბილისი</span>
                        </a>
                        <a href="tel:+995511430101" class="min-w-max flex items-center gap-2"><Phone/> <span>511 430 101</span></a>
                        <a href="mailto:restaurantkakhuriezo@gmail.com" class="min-w-max flex items-center gap-2"><Mail/> <span>restaurantkakhuriezo@gmail.com</span></a>
                    </div>

                    <div class="flex flex-col md:flex-row flex-wrap gap-2">
                        <a href="https://www.facebook.com/restaurantkakhuriezo" target="_blank" class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center"><Facebook/></a>
                        <a href="https://www.instagram.com/restaurantkakhuriezo" target="_blank" class="w-9 h-9 bg-white boxShadow rounded-full flex items-center justify-center"><Instagram/></a>
                        <a href="https://www.tiktok.com/@restaurantkakhuriezo" target="_blank" class="w-9 h-9 bg-white boxShadow rounded-full flex items-center justify-center"><Tiktok/></a>
                    </div>
                </div>

                <hr class="border-gray-500">

                <a href="https://portfolio-gonjila.vercel.app/" target="_blank" class="text-center">{{$t('createdby.part1')}} <span class='text-primary font-bold'>GONJILA</span>{{$t('createdby.part2')}}</a>
            </footer>
        </div>
    </div>
</template>
