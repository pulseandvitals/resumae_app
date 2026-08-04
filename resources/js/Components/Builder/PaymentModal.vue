<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    show: { type: Boolean, default: false },
    template: { type: Object, default: null },
});

defineEmits(['close']);

const methods = ['PayMongo', 'Stripe', 'GCash', 'Maya', 'PayPal', 'Credit/Debit Card'];
</script>

<template>
    <Modal :show="show" max-width="md" @close="$emit('close')">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900">Download your resume</h2>
            <p class="mt-1 text-sm text-gray-500">
                Unlimited edits are free. Pay once to download the finished PDF.
            </p>

            <div class="mt-5 flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3">
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ template?.name ?? 'Selected template' }}</p>
                    <p class="text-xs text-gray-500">One-time payment · unlimited edits before download</p>
                </div>
                <p class="text-2xl font-bold text-gray-900">
                    &#8369;{{ template ? Number(template.price).toFixed(0) : '—' }}
                </p>
            </div>

            <div class="mt-5">
                <p class="text-sm font-medium text-gray-700">Choose a payment method</p>
                <div class="mt-2 grid grid-cols-2 gap-2">
                    <button
                        v-for="method in methods"
                        :key="method"
                        type="button"
                        class="rounded-md border border-gray-200 px-3 py-2 text-sm font-medium text-gray-700 transition hover:border-indigo-300 hover:text-indigo-600"
                        disabled
                    >
                        {{ method }}
                    </button>
                </div>
                <p class="mt-3 text-xs text-gray-400">
                    Payment integration is coming soon — checkout isn't live yet.
                </p>
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="$emit('close')">Close</SecondaryButton>
            </div>
        </div>
    </Modal>
</template>
