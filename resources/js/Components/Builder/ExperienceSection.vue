<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';
import Checkbox from '@/Components/Checkbox.vue';

defineProps({
    experience: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection
        title="Work Experience"
        description="Add as many roles as you'd like, most recent first."
    >
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in experience"
                :key="entry.id"
                :label="`Experience #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.position" label="Position" />
                <BuilderField v-model="entry.company" label="Company / Organization" />
                <BuilderField v-model="entry.location" label="Location" span />

                <div class="grid grid-cols-2 gap-4 sm:col-span-2">
                    <BuilderField v-model="entry.startDate" label="Start Date" type="month" />
                    <BuilderField
                        v-model="entry.endDate"
                        label="End Date"
                        type="month"
                        placeholder="Present"
                        :disabled="entry.current"
                    />
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-600 sm:col-span-2">
                    <Checkbox
                        :checked="entry.current"
                        @update:checked="
                            (value) => {
                                entry.current = value;
                                if (value) entry.endDate = '';
                            }
                        "
                    />
                    Currently working here
                </label>

                <BuilderTextarea v-model="entry.responsibilities" label="Responsibilities" :rows="3" span />
                <BuilderTextarea v-model="entry.achievements" label="Achievements" :rows="3" span />
            </RepeaterCard>

            <AddButton label="Add Work Experience" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
