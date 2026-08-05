<script setup>
import SidebarLayout from './layouts/SidebarLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-slate-600',
    bg: 'bg-slate-900',
    bgSoft: 'bg-slate-50',
    textOnBg: 'text-white',
    chipBg: 'bg-slate-50',
    chipText: 'text-slate-300',
    border: 'border-slate-600',
};
</script>

<template>
    <SidebarLayout :resume="resume" :theme="theme" />
</template>
