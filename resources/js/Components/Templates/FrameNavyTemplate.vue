<script setup>
import FrameLayout from './layouts/FrameLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-slate-700',
    bg: 'bg-slate-800',
    bgSoft: 'bg-slate-50',
    textOnBg: 'text-white',
    chipBg: 'bg-slate-50',
    chipText: 'text-slate-700',
    border: 'border-slate-800',
};
</script>

<template>
    <FrameLayout :resume="resume" :theme="theme" />
</template>
