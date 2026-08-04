<script setup>
import { templateSwatch } from '@/templateSwatches';

defineProps({
    templates: { type: Array, required: true },
    selectedKey: { type: String, required: true },
});

defineEmits(['select']);
</script>

<template>
    <div class="flex gap-3 overflow-x-auto pb-1">
        <button
            v-for="template in templates"
            :key="template.key"
            type="button"
            class="w-28 shrink-0 rounded-lg border-2 p-2 text-left transition"
            :class="template.key === selectedKey ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300'"
            @click="$emit('select', template.key)"
        >
            <div class="flex h-14 flex-col justify-end gap-1 rounded bg-gray-50 p-1.5">
                <div class="h-1.5 w-3/4 rounded-sm" :class="templateSwatch(template.key).accent"></div>
                <div class="h-1 w-full rounded-sm bg-gray-200"></div>
                <div class="h-1 w-2/3 rounded-sm bg-gray-200"></div>
            </div>
            <p class="mt-1.5 truncate text-xs font-semibold text-gray-900">{{ template.name }}</p>
            <p class="text-[11px] text-gray-500">₱{{ Number(template.price).toFixed(0) }}</p>
        </button>
    </div>
</template>
