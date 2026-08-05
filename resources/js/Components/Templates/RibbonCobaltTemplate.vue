<script setup>
import RibbonLayout from './layouts/RibbonLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-blue-600',
    bg: 'bg-blue-600',
    bgSoft: 'bg-blue-50',
    textOnBg: 'text-white',
    chipBg: 'bg-blue-50',
    chipText: 'text-blue-700',
    border: 'border-blue-600',
};
</script>

<template>
    <RibbonLayout :resume="resume" :theme="theme" />
</template>
