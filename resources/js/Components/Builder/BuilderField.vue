<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    label: { type: String, required: true },
    type: { type: String, default: 'text' },
    placeholder: { type: String, default: '' },
    required: { type: Boolean, default: false },
    disabled: { type: Boolean, default: false },
    span: { type: Boolean, default: false },
});

const model = defineModel({ type: String, default: '' });
</script>

<template>
    <div :class="span ? 'sm:col-span-2' : ''">
        <InputLabel :value="label" />
        <TextInput
            v-model="model"
            :type="type"
            :placeholder="placeholder"
            :required="required"
            :disabled="disabled"
            class="mt-1 block w-full disabled:bg-gray-50 disabled:text-gray-400"
        />
    </div>
</template>
