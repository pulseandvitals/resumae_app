<script setup>
import LedgerLayout from './layouts/LedgerLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-gray-700',
    bg: 'bg-gray-700',
    bgSoft: 'bg-gray-50',
    textOnBg: 'text-white',
    chipBg: 'bg-gray-100',
    chipText: 'text-gray-700',
    border: 'border-gray-400',
};
</script>

<template>
    <LedgerLayout :resume="resume" :theme="theme" />
</template>
