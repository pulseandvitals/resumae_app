<script setup>
import CardLayout from './layouts/CardLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-sky-600',
    bg: 'bg-sky-500',
    bgSoft: 'bg-sky-50',
    textOnBg: 'text-white',
    chipBg: 'bg-sky-50',
    chipText: 'text-sky-700',
    border: 'border-sky-500',
};
</script>

<template>
    <CardLayout :resume="resume" :theme="theme" />
</template>
