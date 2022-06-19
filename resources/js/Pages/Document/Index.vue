<script setup>
import { computed } from "vue";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import FilesList from "@/Components/FilesList.vue";

const props = defineProps({
    documents: Array,
});

const documentsCount = computed(() => {
    return props.documents.length;
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <h2
                    class="mb-2 sm:mb-0 font-semibold text-xl text-gray-800 leading-tight"
                >
                    My documents ({{ documentsCount }})
                </h2>
                <Link
                    :href="route('documents.create')"
                    class="px-4 py-2 uppercase font-bold text-sm bg-green-500 text-white rounded-full shadow-sm hover:text-gray-700 transition ease-in-out duration-150"
                >
                    <font-awesome-icon icon="fa-solid fa-upload" class="mr-2" />
                    Upload new document
                </Link>
            </div>
        </template>

        <FilesList />
    </AuthenticatedLayout>
</template>
