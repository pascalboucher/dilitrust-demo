<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    title: String,
});
</script>

<template>
    <div
        class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div class="fixed top-0 right-0 px-6 py-4 block">
            <slot name="nav">
                <Link
                    :href="route('home')"
                    class="text-sm text-gray-700 underline"
                >
                    Home
                </Link>
            </slot>
        </div>

        <div v-if="title" class="text-5xl text-center">
            {{ title }}
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
