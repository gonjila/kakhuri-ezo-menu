<script setup lang="ts">
    import {reactive} from "vue";
    import {Search} from "@/Components/icons";
    import {Link, router} from "@inertiajs/vue3";

    const componentsHeight = '40px'
    const form = reactive({
        search: null,
    })

    function submit() {
        router.get(route('all-products', {search: form.search}));
    }
</script>

<template>
    <div class="flex flex-col-reverse sm:flex-row items-center gap-4 md:gap-[4vw]">
        <Link :href="route('all-products')" :class="`h-[${componentsHeight}]`" class="uppercase blackText boxBg px-10 flex items-center">{{ $t('products.allProducts') }}</Link>

        <form @submit.prevent="submit" class="w-full flex items-center gap-4 flex-1">
            <input type="search" :placeholder="$t('products.search')" v-model="form.search" :class="`h-[${componentsHeight}]`" class="placeholder:capitalize px-4 bg-transparent border border-gray-400 focus:border-gray-400 rounded-lg focus:ring-0 flex-1">

            <button :class="`h-[${componentsHeight}]`" class="aspect-square bg-primary rounded-lg grid place-items-center">
                <Search />
            </button>
        </form>
    </div>
</template>
