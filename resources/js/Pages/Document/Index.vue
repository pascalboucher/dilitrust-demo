<script setup>
import { computed, ref, onMounted } from "vue";
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import { useTimeout } from "vue-composable";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import ListDocuments from "@/Components/ListDocuments.vue";

const props = defineProps({
    documents: Array,
    status: String,
});

const hideStatus = ref(false);

const documentsCount = computed(() => {
    return props.documents.length;
});
const errors = computed(() => usePage().props.value.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);
const flashStatus = () => {
    hideStatus.value = false;
    useTimeout(() => (hideStatus.value = true), 3000);
};

onMounted(() => {
    if (props.status) {
        flashStatus();
    }
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

        <div
            v-if="hasErrors"
            class="mx-auto w-full sm:max-w-md px-1 sm:px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <ValidationErrors />
        </div>

        <div
            v-if="status"
            class="mx-auto w-full sm:max-w-md px-1 sm:px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
            :class="{ hidden: hideStatus, 'mb-5': documents.length === 0 }"
        >
            <div class="font-bold text-center text-sm text-green-600">
                {{ status }}
            </div>
        </div>

        <ListDocuments @document-deleted="flashStatus" :documents="documents" />
    </AuthenticatedLayout>
</template>
