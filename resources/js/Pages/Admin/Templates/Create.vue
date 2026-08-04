<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import TemplateForm from '@/Pages/Admin/Templates/Partials/TemplateForm.vue';

const props = defineProps({
    availableKeys: { type: Array, required: true },
    usedKeys: { type: Array, required: true },
});

const form = useForm({
    key: '',
    name: '',
    description: '',
    price: '',
    sort_order: 0,
    is_active: true,
});

function submit() {
    form.post(route('admin.templates.store'));
}
</script>

<template>
    <Head title="New Template" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">New Template</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <TemplateForm
                        :form="form"
                        :available-keys="availableKeys"
                        :used-keys="usedKeys"
                        submit-label="Create Template"
                        @submit="submit"
                    />

                    <Link :href="route('admin.templates.index')" class="mt-6 inline-block text-sm text-gray-500 hover:text-gray-700">
                        &larr; Back to templates
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
