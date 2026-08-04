<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import InputLabel from '@/Components/InputLabel.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    languages: { type: Array, required: true },
});

defineEmits(['add', 'remove']);

const proficiencyLevels = ['Basic', 'Conversational', 'Fluent', 'Native'];
</script>

<template>
    <BuilderSection title="Languages" optional>
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in languages"
                :key="entry.id"
                :label="`Language #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.language" label="Language" />
                <div>
                    <InputLabel value="Proficiency" />
                    <select
                        v-model="entry.proficiency"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="" disabled>Select level</option>
                        <option v-for="level in proficiencyLevels" :key="level" :value="level">
                            {{ level }}
                        </option>
                    </select>
                </div>
            </RepeaterCard>

            <AddButton label="Add Language" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
