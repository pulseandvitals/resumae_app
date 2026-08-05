<script setup>
import RibbonLayout from './layouts/RibbonLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-rose-600',
    bg: 'bg-rose-600',
    bgSoft: 'bg-rose-50',
    textOnBg: 'text-white',
    chipBg: 'bg-rose-50',
    chipText: 'text-rose-700',
    border: 'border-rose-600',
};
</script>

<template>
    <RibbonLayout :resume="resume" :theme="theme" />
</template>
