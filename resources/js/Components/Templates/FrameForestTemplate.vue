<script setup>
import FrameLayout from './layouts/FrameLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-emerald-700',
    bg: 'bg-emerald-800',
    bgSoft: 'bg-emerald-50',
    textOnBg: 'text-white',
    chipBg: 'bg-emerald-50',
    chipText: 'text-emerald-700',
    border: 'border-emerald-800',
};
</script>

<template>
    <FrameLayout :resume="resume" :theme="theme" />
</template>
