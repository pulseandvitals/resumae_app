<script setup>
import BannerLayout from './layouts/BannerLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-rose-600',
    bg: 'bg-rose-600',
    bgSoft: 'bg-rose-50',
    textOnBg: 'text-white',
    chipBg: 'bg-rose-50',
    chipText: 'text-rose-700',
    border: 'border-rose-600',
};
</script>

<template>
    <BannerLayout :resume="resume" :theme="theme" />
</template>
