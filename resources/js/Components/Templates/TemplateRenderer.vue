<script setup>
import { computed } from 'vue';
import { TEMPLATE_COMPONENTS } from '@/Components/Templates/registry';
import ModernTemplate from '@/Components/Templates/ModernTemplate.vue';

const props = defineProps({
    templateKey: { type: String, default: 'modern' },
    resume: { type: Object, required: true },
});

const component = computed(() => TEMPLATE_COMPONENTS[props.templateKey] ?? ModernTemplate);
</script>

<template>
    <div class="mx-auto w-full max-w-[680px] overflow-hidden shadow-xl ring-1 ring-gray-900/5">
        <component :is="component" :resume="resume" />
    </div>
</template>
