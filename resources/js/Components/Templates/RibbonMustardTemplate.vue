<script setup>
import RibbonLayout from './layouts/RibbonLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-yellow-700',
    bg: 'bg-yellow-600',
    bgSoft: 'bg-yellow-50',
    textOnBg: 'text-white',
    chipBg: 'bg-yellow-50',
    chipText: 'text-yellow-700',
    border: 'border-yellow-700',
};
</script>

<template>
    <RibbonLayout :resume="resume" :theme="theme" />
</template>
