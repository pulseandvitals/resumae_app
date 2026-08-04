<script setup>
defineProps({
    label: { type: String, required: true },
});

defineEmits(['click']);
</script>

<template>
    <button
        type="button"
        class="flex items-center gap-1.5 rounded-md border border-dashed border-gray-300 px-4 py-2 text-sm font-medium text-gray-600 transition hover:border-indigo-300 hover:text-indigo-600"
        @click="$emit('click')"
    >
        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        {{ label }}
    </button>
</template>
