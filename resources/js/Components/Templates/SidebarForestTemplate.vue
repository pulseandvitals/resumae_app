<script setup>
import SidebarLayout from './layouts/SidebarLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-emerald-600',
    bg: 'bg-emerald-900',
    bgSoft: 'bg-emerald-50',
    textOnBg: 'text-white',
    chipBg: 'bg-emerald-50',
    chipText: 'text-emerald-300',
    border: 'border-emerald-600',
};
</script>

<template>
    <SidebarLayout :resume="resume" :theme="theme" />
</template>
