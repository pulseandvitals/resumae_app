<script setup>
defineProps({
    title: { type: String, required: true },
    description: { type: String, default: '' },
    optional: { type: Boolean, default: false },
});
</script>

<template>
    <section class="border-b border-gray-200 py-8 first:pt-0 last:border-b-0">
        <div class="flex items-baseline gap-2">
            <h2 class="text-lg font-semibold text-gray-900">{{ title }}</h2>
            <span v-if="optional" class="text-xs font-medium text-gray-400">(Optional)</span>
        </div>
        <p v-if="description" class="mt-1 text-sm text-gray-500">{{ description }}</p>

        <div class="mt-6">
            <slot />
        </div>
    </section>
</template>
