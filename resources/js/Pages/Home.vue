<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Home" />

    <GuestLayout>
        <template #nav>
            <div class="fixed top-0 right-0 px-6 py-4 block">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('documents.index')"
                    class="text-sm text-gray-700 underline"
                >
                    Dashboard
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-sm text-gray-700 underline"
                    >
                        Log in
                    </Link>

                    <Link
                        :href="route('register')"
                        class="ml-4 text-sm text-gray-700 underline"
                    >
                        Register
                    </Link>
                </template>
            </div>
        </template>

        <div class="my-14 nx-6">
            <h1 class="text-6xl text-center">Dilitrust demo</h1>

            <div class="flex flex-col justify-center mt-4 items-center">
                <div class="text-center text-sm text-gray-700">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
                <div class="text-center text-sm text-gray-700 mt-2">
                    Made by
                    <a
                        href="https://github.com/pascalboucher"
                        class="ml-1 text-sky-500 hover:text-gray-700 transition ease-in-out duration-150"
                        >Pascal Boucher</a
                    >
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
