<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    education: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="Education" description="Add your schools, most recent first.">
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in education"
                :key="entry.id"
                :label="`Education #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.school" label="School" span />
                <BuilderField v-model="entry.degree" label="Degree" />
                <BuilderField v-model="entry.fieldOfStudy" label="Field of Study" />
                <BuilderField v-model="entry.startDate" label="Start Date" type="month" />
                <BuilderField v-model="entry.endDate" label="End Date" type="month" placeholder="Present" />
                <BuilderTextarea
                    v-model="entry.description"
                    label="Description"
                    placeholder="Optional"
                    :rows="2"
                    span
                />
            </RepeaterCard>

            <AddButton label="Add Education" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
