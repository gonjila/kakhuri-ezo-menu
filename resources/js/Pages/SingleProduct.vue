<script setup lang="ts">
    import {computed} from "vue";
    import {Head, Link} from "@inertiajs/vue3";

    import {MainLayout} from "@/Layouts";

    import DiscountBadge from "@/Components/DiscountBadge.vue";
    import ProductItem from "@/Components/ProductItem.vue";
    import LazyImage from "@/Components/LazyImage.vue";

    import {ICategory, IProduct} from "@/types";
    import SocialShare from "@/Components/SocialShare.vue";

    const props = defineProps<{
        product: { data: IProduct }
        categories: { data: ICategory[] }
        similarProducts: { data: IProduct[] }
    }>();

    const computedImageUrl = computed(() => {
        if (!props.product.data.image) return '';
        if (props.product.data.image.startsWith("http")) return props.product.data.image;
        return location.origin + "/storage/" + props.product.data.image;
    });
</script>

<template>
    <Head>
        <title>{{ product.data.name }}</title>
        <meta name="description" :content="product.data.description">

        <!-- Open Graph Meta Tags -->
        <meta property="og:type" content="product">
        <meta property="og:title" :content="product.data.name">
        <meta property="og:description" v-bind:content="product.data.description || 'Default product description here.'">
        <meta property="og:url" :content="route('product', { productId: product.data.id })">
        <meta property="og:image" v-bind:content="computedImageUrl">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:site_name" content="Your Site Name">
        <meta property="og:see_also" :content="route('home')">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" :content="product.data.name">
        <meta name="twitter:description" :content="product.data.description">
        <meta name="twitter:image" v-bind:content="computedImageUrl">
        <meta name="twitter:url" :content="route('product', { productId: product.data.id })">
    </Head>


    <MainLayout>
        <div class="flex flex-col lg:flex-row gap-10">
            <div class="relative flex-[3]">
                <LazyImage :alt="product.data.name" :src="product.data.image" img-class="rounded-lg hover:scale-100" />

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
                            :href="route('all-products', {category_id: category.id})"
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

                <div class="flex flex-col gap-4">
                    <h3 class="capitalize text-lg blackText">{{ $t('titles.share') }}</h3>

<!--                    <social-share :title="product.data.name" :url="route('product', { productId: product.data.id })" :image="computedImageUrl"/>-->
                    <div class="flex gap-5 flex-wrap">
                        <ShareNetwork
                            network="facebook"
                            :url="route('product', {productId: product.data.id})"
                            :title="product.data.name"
                            :description="product.data.description"
                            :hashtags="product.data.name"
                            class="boxBg boxShadow px-3 py-2"
                        >
                            Facebook
                        </ShareNetwork>
                        <ShareNetwork
                            network="LinkedIn"
                            url="https://news.vuejs.org/issues/180"
                            :title="product.data.name"
                            :description="product.data.description"
                            :hashtags="product.data.name"
                            class="boxBg boxShadow px-3 py-2"
                        >
                            twitter
                        </ShareNetwork>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="similarProducts.data.length > 0" class="flex flex-col gap-4">
            <h3 class="capitalize text-lg blackText">{{ $t('titles.similarProducts') }}</h3>

            <ul class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-10">
                <ProductItem v-for="item in similarProducts.data" :data="item" />
            </ul>
        </div>
    </MainLayout>
</template>
