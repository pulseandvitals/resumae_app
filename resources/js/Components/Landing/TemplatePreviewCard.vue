<script setup>
import { Link } from '@inertiajs/vue3';
import TemplateRenderer from '@/Components/Templates/TemplateRenderer.vue';
import { sampleResume } from '@/sampleResume';

defineProps({
    template: { type: Object, required: true },
});

const SCALE = 0.4;
</script>

<template>
    <Link
        :href="route('builder', { template: template.key })"
        class="group block overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg"
    >
        <div class="relative h-56 overflow-hidden bg-gray-50">
            <div
                class="pointer-events-none absolute left-0 top-0 origin-top-left"
                :style="{ transform: `scale(${SCALE})`, width: `${100 / SCALE}%` }"
            >
                <TemplateRenderer :template-key="template.key" :resume="sampleResume" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-white/10 via-transparent to-transparent"></div>
        </div>

        <div class="border-t border-gray-100 p-4">
            <p class="text-sm font-semibold text-gray-900">{{ template.name }}</p>
            <p v-if="template.description" class="mt-0.5 line-clamp-1 text-xs text-gray-500">
                {{ template.description }}
            </p>
        </div>
    </Link>
</template>
