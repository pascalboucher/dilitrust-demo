<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import AddDocument from "@/Components/AddDocument.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

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

        <ValidationErrors class="mb-4" />

        <AddDocument />
    </AuthenticatedLayout>
</template>
