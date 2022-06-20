<script setup>
import { computed } from "vue";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddDocument from "@/Components/AddDocument.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const errors = computed(() => usePage().props.value.errors);

const title = "Add document";
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col justify-between items-start">
                <Link
                    :href="route('documents.index')"
                    class="mb-2 sm:mb-4 lowercase text-sky-500 hover:text-gray-700 transition ease-in-out duration-150"
                >
                    <font-awesome-icon icon="fa-solid fa-chevron-left" />
                    Back to documents list
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Add a document
                </h2>
            </div>
        </template>

        <div
            v-if="hasErrors"
            class="mx-auto w-full sm:max-w-md px-1 sm:px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mb-5"
        >
            <ValidationErrors />
        </div>

        <AddDocument />
    </AuthenticatedLayout>
</template>
