<script setup>
import Button from "@/Components/Button.vue";
import GuestLayout from "@/Layouts/Guest.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";

const title = "Confirm Password";

const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout :title="title">
        <Head :title="title" />

        <template #nav>
            <div class="fixed top-0 right-0 px-6 py-4 block">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('documents')"
                    class="ml-4 text-sm text-gray-700 underline"
                >
                    Dashboard
                </Link>
            </div>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Please confirm your password before continuing.
        </div>

        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <Label for="password" value="Password" />
                <Input
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
            </div>

            <div class="flex justify-end mt-4">
                <Button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
