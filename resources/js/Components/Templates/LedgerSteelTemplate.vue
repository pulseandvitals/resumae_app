<script setup>
import LedgerLayout from './layouts/LedgerLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-slate-700',
    bg: 'bg-slate-700',
    bgSoft: 'bg-slate-50',
    textOnBg: 'text-white',
    chipBg: 'bg-slate-100',
    chipText: 'text-slate-700',
    border: 'border-slate-400',
};
</script>

<template>
    <LedgerLayout :resume="resume" :theme="theme" />
</template>
