<script setup>
import BannerLayout from './layouts/BannerLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-slate-600',
    bg: 'bg-slate-600',
    bgSoft: 'bg-slate-50',
    textOnBg: 'text-white',
    chipBg: 'bg-slate-50',
    chipText: 'text-slate-700',
    border: 'border-slate-600',
};
</script>

<template>
    <BannerLayout :resume="resume" :theme="theme" />
</template>
