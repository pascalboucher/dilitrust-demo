<script setup>
import { ref } from "vue";
import Button from "@/Components/Button.vue";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    status: String,
});

const title = "Add document";

const url = ref("");
const fileType = ref("");

const form = useForm({
    file: null,
});

const submit = () => {
    console.log("form", form.file);
    //form.post(route("login"), {});
};

const onFileChange = (e) => {
    const file = e.target.files[0];
    fileType.value = file.type;
    url.value = URL.createObjectURL(file);
};
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="title" />

        <ValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <template #header>
            <div class="flex flex-col justify-between items-start">
                <Link
                    :href="route('documents')"
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
            class="mx-auto w-full sm:max-w-md px-1 sm:px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <form @submit.prevent="submit">
                <div class="flex flex-col items-end justify-end">
                    <template v-if="url">
                        <div
                            v-if="fileType === 'application/pdf'"
                            class="relative overflow-hidden h-0 w-full pb-[100%]"
                        >
                            <embed
                                v-if="fileType === 'application/pdf'"
                                :src="url"
                                width="400"
                                height="500"
                                class="absolute w-full h-full"
                            />
                        </div>
                        <img v-else class="max-w-full" :src="url" />
                    </template>

                    <div v-else class="flex justify-center items-center w-full">
                        <label
                            for="dropzone-file"
                            class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                        >
                            <div
                                class="flex flex-col justify-center items-center pt-5 pb-6"
                            >
                                <svg
                                    class="mb-3 w-10 h-10 text-gray-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                    ></path>
                                </svg>
                                <p
                                    class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                                >
                                    <span class="font-semibold"
                                        >Click to upload</span
                                    >
                                </p>
                                <p
                                    class="text-xs text-gray-500 dark:text-gray-400"
                                >
                                    PNG, JPG or PDF (MAX. 2MB)
                                </p>
                            </div>
                            <input
                                id="dropzone-file"
                                type="file"
                                class="hidden"
                                accept="image/png, image/jpeg, application/pdf"
                                @input="form.file = $event.target.files[0]"
                                @change="onFileChange"
                            />
                            <progress
                                v-if="form.progress"
                                :value="form.progress.percentage"
                                max="100"
                            >
                                {{ form.progress.percentage }}%
                            </progress>
                        </label>
                    </div>
                    <Button
                        class="mt-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Upload
                    </Button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
