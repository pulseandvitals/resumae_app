<script setup>
import { computed } from 'vue';
import { templateSwatch } from '@/templateSwatches';

const props = defineProps({
    templates: { type: Array, required: true },
    selectedKey: { type: String, required: true },
    recommendedKeys: { type: Set, default: () => new Set() },
});

defineEmits(['select']);

const orderedTemplates = computed(() => {
    if (!props.recommendedKeys.size) return props.templates;
    return [...props.templates].sort((a, b) => {
        const aRecommended = props.recommendedKeys.has(a.key) ? 0 : 1;
        const bRecommended = props.recommendedKeys.has(b.key) ? 0 : 1;
        return aRecommended - bRecommended;
    });
});
</script>

<template>
    <div class="flex gap-3 overflow-x-auto pb-1 pt-3">
        <button
            v-for="template in orderedTemplates"
            :key="template.key"
            type="button"
            class="relative w-28 shrink-0 rounded-lg border-2 p-2 text-left transition"
            :class="template.key === selectedKey ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300'"
            @click="$emit('select', template.key)"
        >
            <span
                v-if="recommendedKeys.has(template.key)"
                class="absolute -top-2 left-2 rounded-full bg-emerald-500 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wide text-white shadow-sm"
            >
                Recommended
            </span>
            <div class="flex h-14 flex-col justify-end gap-1 rounded bg-gray-50 p-1.5">
                <div class="h-1.5 w-3/4 rounded-sm" :class="templateSwatch(template.key).accent"></div>
                <div class="h-1 w-full rounded-sm bg-gray-200"></div>
                <div class="h-1 w-2/3 rounded-sm bg-gray-200"></div>
            </div>
            <p class="mt-1.5 truncate text-xs font-semibold text-gray-900">{{ template.name }}</p>
        </button>
    </div>
</template>
