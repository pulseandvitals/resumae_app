<script setup>
import InputLabel from '@/Components/InputLabel.vue';

defineProps({
    label: { type: String, required: true },
    placeholder: { type: String, default: '' },
    rows: { type: Number, default: 4 },
    span: { type: Boolean, default: false },
});

const model = defineModel({ type: String, default: '' });
</script>

<template>
    <div :class="span ? 'sm:col-span-2' : ''">
        <InputLabel :value="label" />
        <textarea
            v-model="model"
            :rows="rows"
            :placeholder="placeholder"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        ></textarea>
    </div>
</template>
