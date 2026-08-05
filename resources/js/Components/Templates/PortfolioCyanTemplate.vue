<script setup>
import PortfolioLayout from './layouts/PortfolioLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-cyan-700',
    bg: 'bg-cyan-700',
    bgSoft: 'bg-cyan-50',
    textOnBg: 'text-white',
    chipBg: 'bg-cyan-50',
    chipText: 'text-cyan-700',
    border: 'border-cyan-700',
};
</script>

<template>
    <PortfolioLayout :resume="resume" :theme="theme" />
</template>
