<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    stats: { type: Object, required: true },
    recentPayments: { type: Array, required: true },
});

const statusStyles = {
    paid: 'bg-green-100 text-green-700',
    pending: 'bg-amber-100 text-amber-700',
    failed: 'bg-red-100 text-red-700',
    refunded: 'bg-gray-100 text-gray-600',
};

function formatCurrency(value) {
    return `₱${Number(value).toFixed(2)}`;
}

function formatDate(value) {
    if (!value) return '—';
    return new Date(value).toLocaleString('en-PH', { dateStyle: 'medium', timeStyle: 'short' });
}
</script>

<template>
    <Head title="Payments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Payments</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-gray-900/5">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Total Payments</p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">{{ stats.total }}</p>
                    </div>
                    <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-gray-900/5">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Successfully Paid</p>
                        <p class="mt-2 text-2xl font-bold text-green-600">{{ stats.paid }}</p>
                    </div>
                    <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-gray-900/5">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Paid &amp; PDF Uploaded</p>
                        <p class="mt-2 text-2xl font-bold text-indigo-600">{{ stats.paidAndUploaded }}</p>
                    </div>
                    <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-gray-900/5">
                        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">Revenue</p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">{{ formatCurrency(stats.revenue) }}</p>
                    </div>
                </div>

                <div class="mt-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Template</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">PDF Uploaded</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr v-for="payment in recentPayments" :key="payment.id">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-gray-900">{{ payment.customer_name || 'Guest' }}</p>
                                    <p class="text-xs text-gray-400">{{ payment.customer_email || '—' }}</p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                                    {{ payment.resume_template?.name ?? '—' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ formatCurrency(payment.amount) }}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="rounded-full px-2.5 py-0.5 text-xs font-medium capitalize"
                                        :class="statusStyles[payment.status] ?? 'bg-gray-100 text-gray-600'"
                                    >
                                        {{ payment.status }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span v-if="payment.pdf_uploaded_at" class="text-green-600">Yes</span>
                                    <span v-else class="text-gray-400">No</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ formatDate(payment.created_at) }}</td>
                            </tr>

                            <tr v-if="!recentPayments.length">
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-400">
                                    No payments yet.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
