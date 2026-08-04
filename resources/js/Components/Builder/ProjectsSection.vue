<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    projects: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="Projects" optional description="Showcase things you've built.">
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in projects"
                :key="entry.id"
                :label="`Project #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.name" label="Project Name" />
                <BuilderField v-model="entry.organization" label="Organization" placeholder="Optional" />
                <BuilderTextarea v-model="entry.description" label="Description" :rows="3" span />
                <BuilderField v-model="entry.startDate" label="Start Date" type="month" />
                <BuilderField v-model="entry.endDate" label="End Date" type="month" placeholder="Present" />
            </RepeaterCard>

            <AddButton label="Add Project" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
