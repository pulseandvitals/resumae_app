<script setup>
import BannerLayout from './layouts/BannerLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-teal-600',
    bg: 'bg-teal-600',
    bgSoft: 'bg-teal-50',
    textOnBg: 'text-white',
    chipBg: 'bg-teal-50',
    chipText: 'text-teal-700',
    border: 'border-teal-600',
};
</script>

<template>
    <BannerLayout :resume="resume" :theme="theme" />
</template>
