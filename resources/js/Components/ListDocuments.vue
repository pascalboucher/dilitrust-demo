<script setup>
import { reactive, computed, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    documents: Array,
});

const state = reactive({
    selected: [],
    selectAll: false,
});

watch(
    () => state.selected,
    (selected) => {
        state.selectAll = selected.length === props.documents.length;
    }
);

const updateCheckboxes = (e) => {
    if (e.target.checked) {
        state.selected = props.documents.map((document) => document.id);
    } else {
        state.selected = [];
    }
};

const lastDocumentIndex = computed(() => {
    return props.documents.length - 1;
});

const hasSelections = computed(() => {
    return state.selected.length > 0;
});

const hasDocuments = computed(() => {
    return props.documents.length > 0;
});
</script>

<template>
    <div class="lg:w-10/12 sm:mx-auto">
        <template v-if="hasDocuments">
            <div v-show="hasSelections" class="absolute flex ml-1 sm:ml-0">
                <Link
                    href="/"
                    class="uppercase font-bold text-sm text-red-500 hover:text-gray-700 transition ease-in-out duration-150"
                >
                    <font-awesome-icon icon="fa-solid fa-trash" class="mr-2" />
                    Delete {{ state.selected.length }}
                    {{ state.selected.length === 1 ? "document" : "documents" }}
                </Link>
            </div>
            <div class="h-6 sm:h-5"></div>
            <div class="border-gray-200 w-100">
                <div
                    class="grid grid-rows-2 grid-cols-2 sm:grid-cols-7 sm:grid-rows-1 gap-4 shadow p-2 bg-indigo-500 text-white font-bold uppercase"
                >
                    <div class="border-r flex items-center justify-center">
                        <Checkbox
                            v-model:checked="state.selectAll"
                            @change="updateCheckboxes"
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
                        v-for="(document, index) in props.documents"
                        :key="index"
                    >
                        <div class="flex items-center justify-center border-r">
                            <Checkbox
                                :value="document.id"
                                v-model:checked="state.selected"
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
                            <Link
                                :href="route('home')"
                                method="get"
                                as="button"
                                type="button"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-download"
                                    class="fa-xl hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                />
                            </Link>
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
