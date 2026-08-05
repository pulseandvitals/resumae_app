<script setup>
import IconAccentLayout from './layouts/IconAccentLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-orange-600',
    bg: 'bg-orange-600',
    bgSoft: 'bg-orange-50',
    textOnBg: 'text-white',
    chipBg: 'bg-orange-50',
    chipText: 'text-orange-700',
    border: 'border-orange-600',
};
</script>

<template>
    <IconAccentLayout :resume="resume" :theme="theme" />
</template>
