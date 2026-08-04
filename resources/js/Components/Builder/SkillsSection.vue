<script setup>
import { ref } from 'vue';
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    skills: { type: Array, required: true },
});

const emit = defineEmits(['add', 'remove']);

const newSkill = ref('');

function submitSkill() {
    if (!newSkill.value.trim()) return;
    emit('add', newSkill.value);
    newSkill.value = '';
}
</script>

<template>
    <BuilderSection
        title="Skills"
        description="e.g. Laravel, Vue.js, PHP, MySQL, Tailwind CSS"
    >
        <InputLabel value="Add a skill" />
        <div class="mt-1 flex gap-2">
            <TextInput
                v-model="newSkill"
                placeholder="e.g. Laravel"
                class="block w-full max-w-xs"
                @keydown.enter.prevent="submitSkill"
            />
            <button
                type="button"
                class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-200"
                @click="submitSkill"
            >
                Add
            </button>
        </div>

        <div v-if="skills.length" class="mt-4 flex flex-wrap gap-2">
            <span
                v-for="skill in skills"
                :key="skill"
                class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700"
            >
                {{ skill }}
                <button
                    type="button"
                    class="text-indigo-400 transition hover:text-indigo-600"
                    @click="$emit('remove', skill)"
                >
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </span>
        </div>
    </BuilderSection>
</template>
