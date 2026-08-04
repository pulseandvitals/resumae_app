<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    trainings: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="Trainings & Seminars" optional>
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in trainings"
                :key="entry.id"
                :label="`Training #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.name" label="Training Name" span />
                <BuilderField v-model="entry.organizer" label="Organizer" />
                <BuilderField v-model="entry.date" label="Date" type="month" />
                <BuilderTextarea v-model="entry.description" label="Description" :rows="2" span />
            </RepeaterCard>

            <AddButton label="Add Training" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
