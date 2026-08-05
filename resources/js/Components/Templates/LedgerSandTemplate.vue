<script setup>
import LedgerLayout from './layouts/LedgerLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-stone-700',
    bg: 'bg-stone-700',
    bgSoft: 'bg-stone-50',
    textOnBg: 'text-white',
    chipBg: 'bg-stone-100',
    chipText: 'text-stone-700',
    border: 'border-stone-400',
};
</script>

<template>
    <LedgerLayout :resume="resume" :theme="theme" />
</template>
