<script setup>
import PortfolioLayout from './layouts/PortfolioLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-amber-700',
    bg: 'bg-amber-700',
    bgSoft: 'bg-amber-50',
    textOnBg: 'text-white',
    chipBg: 'bg-amber-50',
    chipText: 'text-amber-700',
    border: 'border-amber-700',
};
</script>

<template>
    <PortfolioLayout :resume="resume" :theme="theme" />
</template>
