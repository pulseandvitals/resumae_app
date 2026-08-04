<script setup>
import { ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';

const photo = defineModel({ type: String, default: '' });

const fileInput = ref(null);

function onFileChange(event) {
    const file = event.target.files?.[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = () => {
        photo.value = reader.result;
    };
    reader.readAsDataURL(file);
}

function removePhoto() {
    photo.value = '';
    if (fileInput.value) fileInput.value.value = '';
}
</script>

<template>
    <div>
        <InputLabel value="Profile Photo" />
        <div class="mt-1 flex items-center gap-4">
            <div
                class="flex size-16 shrink-0 items-center justify-center overflow-hidden rounded-full bg-gray-100 text-gray-400"
            >
                <img v-if="photo" :src="photo" alt="Profile photo" class="size-full object-cover" />
                <svg v-else class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    class="rounded-md border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:border-indigo-300 hover:text-indigo-600"
                    @click="fileInput.click()"
                >
                    {{ photo ? 'Change' : 'Upload' }}
                </button>
                <button
                    v-if="photo"
                    type="button"
                    class="text-sm font-medium text-red-500 transition hover:text-red-600"
                    @click="removePhoto"
                >
                    Remove
                </button>
            </div>

            <input
                ref="fileInput"
                type="file"
                accept="image/*"
                class="hidden"
                @change="onFileChange"
            />
        </div>
        <p class="mt-1 text-xs text-gray-400">Optional. JPG or PNG.</p>
    </div>
</template>
