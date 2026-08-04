<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { templateSwatch } from '@/templateSwatches';

defineProps({
    templates: { type: Array, required: true },
});

const page = usePage();

function toggleActive(template) {
    router.patch(route('admin.templates.toggle', template.id), {}, { preserveScroll: true });
}

function destroy(template) {
    if (confirm(`Delete the "${template.name}" template? This can't be undone.`)) {
        router.delete(route('admin.templates.destroy', template.id), { preserveScroll: true });
    }
}
</script>

<template>
    <Head title="Resume Templates" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Resume Templates</h2>
                <Link :href="route('admin.templates.create')">
                    <PrimaryButton>New Template</PrimaryButton>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <div
                    v-if="page.props.flash?.status"
                    class="mb-4 rounded-md bg-green-50 px-4 py-3 text-sm font-medium text-green-700"
                >
                    {{ page.props.flash.status }}
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Template</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Order</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="template in templates" :key="template.id">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="size-6 shrink-0 rounded-full" :class="templateSwatch(template.key).accent"></span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ template.name }}</p>
                                            <p class="text-xs text-gray-400">{{ template.key }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                    &#8369;{{ Number(template.price).toFixed(2) }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ template.sort_order }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <button
                                        type="button"
                                        class="rounded-full px-2.5 py-0.5 text-xs font-medium transition"
                                        :class="template.is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                                        @click="toggleActive(template)"
                                    >
                                        {{ template.is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                    <Link
                                        :href="route('admin.templates.edit', template.id)"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        class="ml-4 font-medium text-red-500 hover:text-red-600"
                                        @click="destroy(template)"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <tr v-if="!templates.length">
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-400">
                                    No templates yet.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
