<script setup>
import FrameLayout from './layouts/FrameLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-amber-800',
    bg: 'bg-amber-800',
    bgSoft: 'bg-amber-50',
    textOnBg: 'text-white',
    chipBg: 'bg-amber-50',
    chipText: 'text-amber-800',
    border: 'border-amber-800',
};
</script>

<template>
    <FrameLayout :resume="resume" :theme="theme" />
</template>
