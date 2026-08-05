<script setup>
import SplitHeaderLayout from './layouts/SplitHeaderLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-emerald-600',
    bg: 'bg-emerald-600',
    bgSoft: 'bg-emerald-50',
    textOnBg: 'text-white',
    chipBg: 'bg-emerald-50',
    chipText: 'text-emerald-700',
    border: 'border-emerald-600',
};
</script>

<template>
    <SplitHeaderLayout :resume="resume" :theme="theme" />
</template>
