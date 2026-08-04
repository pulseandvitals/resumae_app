<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import TemplateForm from '@/Pages/Admin/Templates/Partials/TemplateForm.vue';

const props = defineProps({
    template: { type: Object, required: true },
    availableKeys: { type: Array, required: true },
    usedKeys: { type: Array, required: true },
});

const form = useForm({
    key: props.template.key,
    name: props.template.name,
    description: props.template.description ?? '',
    price: props.template.price,
    sort_order: props.template.sort_order,
    is_active: props.template.is_active,
});

function submit() {
    form.put(route('admin.templates.update', props.template.id));
}
</script>

<template>
    <Head title="Edit Template" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Edit Template</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <TemplateForm
                        :form="form"
                        :available-keys="availableKeys"
                        :used-keys="usedKeys"
                        submit-label="Save Changes"
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
