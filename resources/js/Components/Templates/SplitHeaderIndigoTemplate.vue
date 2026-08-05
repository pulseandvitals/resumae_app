<script setup>
import SplitHeaderLayout from './layouts/SplitHeaderLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-indigo-600',
    bg: 'bg-indigo-600',
    bgSoft: 'bg-indigo-50',
    textOnBg: 'text-white',
    chipBg: 'bg-indigo-50',
    chipText: 'text-indigo-700',
    border: 'border-indigo-600',
};
</script>

<template>
    <SplitHeaderLayout :resume="resume" :theme="theme" />
</template>
