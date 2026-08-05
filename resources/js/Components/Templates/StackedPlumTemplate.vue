<script setup>
import StackedLayout from './layouts/StackedLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-purple-600',
    bg: 'bg-purple-600',
    bgSoft: 'bg-purple-50',
    textOnBg: 'text-white',
    chipBg: 'bg-purple-50',
    chipText: 'text-purple-700',
    border: 'border-purple-600',
};
</script>

<template>
    <StackedLayout :resume="resume" :theme="theme" />
</template>
