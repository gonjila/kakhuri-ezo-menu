<script setup lang="ts">
    import {Head} from "@inertiajs/vue3";
    import {MainLayout} from "@/Layouts";
    import {ICategory, IProduct} from "@/types";
    import {Link} from '@inertiajs/vue3'
    import DiscountBadge from "@/Components/DiscountBadge.vue";

    defineProps<{
        product: { data: IProduct }
        categories: { data: ICategory[] }
    }>();
</script>

<template>
    <Head title="SingleProduct" />

    <MainLayout>
        <div class="flex gap-10">
            <div class="relative flex-[3]">
<!--                    :src="product.data.image"-->
                <img
                    src="https://bonee.blob.core.windows.net/images/a30bc6cf-905b-a34b-b70a-6aaee0b97dc6_3.webp"
                    :alt="product.data.name"
                    class="rounded-lg"
                >

                <DiscountBadge :discount="product.data.discount" />
            </div>

            <div class="flex-[4] flex flex-col gap-10">
                <div class="flex flex-col gap-3">
                    <h1 class="blackText text-2xl capitalize">{{ product.data.name }}</h1>
                    <h2 class="grayText text-lg">{{product.data.description}}</h2>
                </div>

                <div class="flex flex-col gap-4">
                    <h3 class="capitalize text-lg blackText">{{ $t('titles.categories') }}</h3>

                    <div class="flex flex-wrap gap-3">
                        <Link
                            v-for="category in categories.data"
                            :href="route('all-products')"
                            class="boxBg boxShadow px-4 py-2"
                        >
                            {{ category.title }}
                        </Link>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <h3 class="capitalize text-lg blackText">{{ $t('titles.price') }}</h3>

                    <div class="text-xl flex gap-5">
                        <div class="flex gap-2 items-center">
                            <span :class="product.data.discounted_price ? 'text-base line-through grayText':'text-primary font-bold'">{{product.data.price}}</span>
                            <span v-if="product.data.discounted_price" class="text-primary font-bold">{{product.data.discounted_price}}</span>
                        </div>

                        <span class="blackText">GEL</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <h3 class="">similar</h3>

            <div class=""></div>
        </div>
    </MainLayout>
</template>
