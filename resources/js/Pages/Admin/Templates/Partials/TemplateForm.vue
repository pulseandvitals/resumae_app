<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { templateSwatch } from '@/templateSwatches';

const props = defineProps({
    form: { type: Object, required: true },
    availableKeys: { type: Array, required: true },
    usedKeys: { type: Array, required: true },
    submitLabel: { type: String, default: 'Save' },
});

const emit = defineEmits(['submit']);

function isKeyDisabled(key) {
    return props.usedKeys.includes(key) && key !== props.form.key;
}
</script>

<template>
    <form class="space-y-6" @submit.prevent="emit('submit')">
        <div>
            <InputLabel value="Design" />
            <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-5">
                <label
                    v-for="key in availableKeys"
                    :key="key"
                    class="flex cursor-pointer flex-col items-center gap-1.5 rounded-lg border-2 p-2 text-center transition"
                    :class="[
                        form.key === key ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 hover:border-gray-300',
                        isKeyDisabled(key) ? 'cursor-not-allowed opacity-40' : '',
                    ]"
                >
                    <input
                        type="radio"
                        :value="key"
                        v-model="form.key"
                        :disabled="isKeyDisabled(key)"
                        class="sr-only"
                    />
                    <span class="size-4 rounded-full" :class="templateSwatch(key).accent"></span>
                    <span class="text-xs font-medium capitalize text-gray-700">{{ key }}</span>
                </label>
            </div>
            <InputError class="mt-2" :message="form.errors.key" />
        </div>

        <div>
            <InputLabel for="name" value="Name" />
            <TextInput id="name" v-model="form.name" class="mt-1 block w-full" required />
            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div>
            <InputLabel for="description" value="Description" />
            <textarea
                id="description"
                v-model="form.description"
                rows="2"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            ></textarea>
            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <InputLabel for="price" value="Price (PHP)" />
                <TextInput id="price" v-model="form.price" type="number" step="0.01" min="0" class="mt-1 block w-full" required />
                <InputError class="mt-2" :message="form.errors.price" />
            </div>
            <div>
                <InputLabel for="sort_order" value="Sort Order" />
                <TextInput id="sort_order" v-model="form.sort_order" type="number" min="0" class="mt-1 block w-full" />
                <InputError class="mt-2" :message="form.errors.sort_order" />
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm text-gray-700">
            <Checkbox v-model:checked="form.is_active" />
            Active (visible to visitors in the builder)
        </label>

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">{{ submitLabel }}</PrimaryButton>
        </div>
    </form>
</template>
