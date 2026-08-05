<script setup>
import CardLayout from './layouts/CardLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-lime-700',
    bg: 'bg-lime-500',
    bgSoft: 'bg-lime-50',
    textOnBg: 'text-white',
    chipBg: 'bg-lime-50',
    chipText: 'text-lime-700',
    border: 'border-lime-500',
};
</script>

<template>
    <CardLayout :resume="resume" :theme="theme" />
</template>
