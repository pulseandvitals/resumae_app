<script setup>
import IconAccentLayout from './layouts/IconAccentLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-lime-700',
    bg: 'bg-lime-700',
    bgSoft: 'bg-lime-50',
    textOnBg: 'text-white',
    chipBg: 'bg-lime-50',
    chipText: 'text-lime-700',
    border: 'border-lime-700',
};
</script>

<template>
    <IconAccentLayout :resume="resume" :theme="theme" />
</template>
