<script setup>
import { computed, ref } from "vue";
import { useTimeout } from "vue-composable";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ListDocuments from "@/Components/ListDocuments.vue";

const props = defineProps({
    documents: Array,
    status: String,
});

const documentsCount = computed(() => {
    return props.documents.length;
});

const hideStatus = ref(false);

if (props.status) {
    useTimeout(() => (hideStatus.value = true), 3000);
}

const errors = computed(() => usePage().props.value.errors);
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
            :class="{ invisible: hideStatus }"
        >
            <div class="font-bold text-center text-sm text-green-600">
                {{ status }}
            </div>
        </div>

        <ListDocuments />
    </AuthenticatedLayout>
</template>
