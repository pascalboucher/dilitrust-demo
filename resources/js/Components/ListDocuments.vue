<script setup>
import { ref, computed, watch } from "vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import Checkbox from "@/Components/Checkbox.vue";
import SubmitButton from "@/Components/Button.vue";

const props = defineProps({
    documents: Array,
});

const emit = defineEmits(["documentDeleted"]);

const selectAll = ref(false);

const form = useForm({
    documents: [],
});

const submit = () => {
    form.delete(route("documents.destroy"), {
        onFinish: () => {
            form.documents = [];
            emit("documentDeleted");
        },
    });
};

watch(
    () => form.documents,
    (documents) => {
        selectAll.value = documents.length === props.documents.length;
    }
);

const updateSelections = (e) => {
    if (e.target.checked) {
        form.documents = props.documents.map((document) => document.id);
    } else {
        form.documents = [];
    }
};

const lastDocumentIndex = computed(() => {
    return props.documents.length - 1;
});

const hasDocuments = computed(() => {
    return props.documents.length > 0;
});

const hasSelections = computed(() => {
    return form.documents.length > 0;
});

const selectionsCount = computed(() => {
    return form.documents.length;
});
</script>

<template>
    <div class="lg:w-10/12 sm:mx-auto">
        <template v-if="hasDocuments">
            <div v-show="hasSelections" class="absolute flex ml-1 sm:ml-0">
                <form @submit.prevent="submit">
                    <SubmitButton
                        class="bg-red-500"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-trash"
                            class="mr-2"
                        />
                        Delete {{ selectionsCount }}
                        {{ selectionsCount === 1 ? "document" : "documents" }}
                    </SubmitButton>
                </form>
            </div>
            <div class="h-10 sm:h-10"></div>
            <div class="border-gray-200 w-100">
                <div
                    class="grid grid-rows-2 grid-cols-2 sm:grid-cols-7 sm:grid-rows-1 gap-4 shadow p-2 bg-indigo-500 text-white font-bold uppercase"
                >
                    <div class="border-r flex items-center justify-center">
                        <Checkbox
                            v-model:checked="selectAll"
                            @change="updateSelections"
                        />
                    </div>
                    <div
                        class="sm:border-r flex items-center justify-center sm:col-span-3"
                    >
                        File
                    </div>
                    <div
                        class="border-r flex items-center justify-center sm:col-span-2"
                    >
                        Size
                    </div>
                    <div class="flex items-center justify-center">Download</div>
                </div>
                <div
                    class="grid grid-cols-2 sm:grid-cols-7 gap-4 px-2 py-4 border border-2 border-t-0 bg-white"
                >
                    <template
                        v-for="(document, index) in documents"
                        :key="index"
                    >
                        <div class="flex items-center justify-center border-r">
                            <Checkbox
                                :value="document.id"
                                v-model:checked="form.documents"
                            />
                        </div>
                        <div
                            class="flex items-center justify-center sm:border-r sm:col-span-3"
                        >
                            {{ document.name }}
                        </div>
                        <div
                            class="flex items-center justify-center border-r sm:col-span-2"
                        >
                            {{ document.size }}
                        </div>
                        <div class="flex items-center justify-center">
                            <a
                                :href="
                                    route('documents.show', {
                                        document: document.id,
                                    })
                                "
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-download"
                                    class="fa-xl hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                />
                            </a>
                        </div>
                        <hr
                            class="col-span-2 sm:col-span-7"
                            v-if="index < lastDocumentIndex"
                        />
                    </template>
                </div>
            </div>
        </template>
        <div
            v-else
            class="bg-white shadow-md overflow-hidden sm:rounded-lg p-10"
        >
            <div class="flex flex-col items-center">
                <h3
                    class="mb-2 font-semibold text-xl text-gray-800 leading-tight"
                >
                    No document!
                </h3>
                <p class="mb-2">
                    Dilitrust-demo allows you to easily store your images and
                    pdfs in a secure cloud service.
                </p>
                <p>
                    To get started :
                    <Link
                        :href="route('documents.create')"
                        class="lowercase text-sky-500 hover:text-gray-700 transition ease-in-out duration-150"
                    >
                        Follow this link
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>
