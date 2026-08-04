<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    volunteer: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="Volunteer Experience" optional>
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in volunteer"
                :key="entry.id"
                :label="`Volunteer #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.organization" label="Organization" />
                <BuilderField v-model="entry.role" label="Role" />
                <BuilderField v-model="entry.startDate" label="Start Date" type="month" />
                <BuilderField v-model="entry.endDate" label="End Date" type="month" placeholder="Present" />
                <BuilderTextarea v-model="entry.description" label="Description" :rows="2" span />
            </RepeaterCard>

            <AddButton label="Add Volunteer Experience" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
