<script setup>
import StackedLayout from './layouts/StackedLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-gray-600',
    bg: 'bg-gray-600',
    bgSoft: 'bg-gray-50',
    textOnBg: 'text-white',
    chipBg: 'bg-gray-50',
    chipText: 'text-gray-700',
    border: 'border-gray-600',
};
</script>

<template>
    <StackedLayout :resume="resume" :theme="theme" />
</template>
