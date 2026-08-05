<script setup>
import SplitHeaderLayout from './layouts/SplitHeaderLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-red-800',
    bg: 'bg-red-800',
    bgSoft: 'bg-red-50',
    textOnBg: 'text-white',
    chipBg: 'bg-red-50',
    chipText: 'text-red-800',
    border: 'border-red-800',
};
</script>

<template>
    <SplitHeaderLayout :resume="resume" :theme="theme" />
</template>
