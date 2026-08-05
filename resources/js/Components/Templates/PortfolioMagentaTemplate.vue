<script setup>
import PortfolioLayout from './layouts/PortfolioLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-pink-600',
    bg: 'bg-pink-600',
    bgSoft: 'bg-pink-50',
    textOnBg: 'text-white',
    chipBg: 'bg-pink-50',
    chipText: 'text-pink-700',
    border: 'border-pink-600',
};
</script>

<template>
    <PortfolioLayout :resume="resume" :theme="theme" />
</template>
