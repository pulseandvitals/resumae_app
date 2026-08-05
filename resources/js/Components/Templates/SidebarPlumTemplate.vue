<script setup>
import SidebarLayout from './layouts/SidebarLayout.vue';

defineProps({
    resume: { type: Object, required: true },
});

const theme = {
    text: 'text-purple-600',
    bg: 'bg-purple-900',
    bgSoft: 'bg-purple-50',
    textOnBg: 'text-white',
    chipBg: 'bg-purple-50',
    chipText: 'text-purple-300',
    border: 'border-purple-600',
};
</script>

<template>
    <SidebarLayout :resume="resume" :theme="theme" />
</template>
