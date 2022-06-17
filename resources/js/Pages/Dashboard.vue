<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Checkbox from "@/Components/Checkbox.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10"
                >
                    <div class="sm:w-10/12 sm:mx-auto">
                        <div class="flex justify-between"></div>

                        <div class="border-gray-200 w-100">
                            <div
                                class="grid grid-cols-7 gap-4 shadow p-2 bg-indigo-500 text-white font-bold uppercase"
                            >
                                <div class="border-r text-center">ID</div>
                                <div class="border-r text-center col-span-3">
                                    Nom du fichier
                                </div>
                                <div class="border-r text-center col-span-2">
                                    Taille du fichier
                                </div>
                                <div class="text-center">Télécharger</div>
                            </div>
                            <div
                                class="grid grid-cols-7 gap-4 px-2 py-4 border border-2 border-t-0"
                            >
                                <div
                                    class="border-b flex items-center justify-center pl-2"
                                >
                                    #1
                                    <Checkbox class="ml-3" />
                                </div>
                                <div
                                    class="border-b flex items-center justify-center pl-2 col-span-3"
                                >
                                    My document.pdf
                                </div>
                                <div
                                    class="border-b flex items-center justify-center pl-2 col-span-2"
                                >
                                    2 mb
                                </div>
                                <div
                                    class="border-b flex items-center justify-center pl-2 pb-1"
                                >
                                    <font-awesome-icon
                                        icon="fa-solid fa-upload"
                                        class="fa-xl hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
