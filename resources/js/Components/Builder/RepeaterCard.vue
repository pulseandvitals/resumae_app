<script setup>
defineProps({
    label: { type: String, default: '' },
});

defineEmits(['remove']);
</script>

<template>
    <div class="relative rounded-lg border border-gray-200 p-5">
        <div class="flex items-center justify-between">
            <span v-if="label" class="text-sm font-medium text-gray-500">{{ label }}</span>
            <button
                type="button"
                class="ml-auto flex items-center gap-1 text-sm font-medium text-red-500 transition hover:text-red-600"
                @click="$emit('remove')"
            >
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Remove
            </button>
        </div>

        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <slot />
        </div>
    </div>
</template>
