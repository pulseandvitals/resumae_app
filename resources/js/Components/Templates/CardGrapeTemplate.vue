<script setup>
import CardLayout from './layouts/CardLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-violet-600',
    bg: 'bg-violet-500',
    bgSoft: 'bg-violet-50',
    textOnBg: 'text-white',
    chipBg: 'bg-violet-50',
    chipText: 'text-violet-700',
    border: 'border-violet-500',
};
</script>

<template>
    <CardLayout :resume="resume" :theme="theme" />
</template>
