<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    awards: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="Awards & Achievements" optional>
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in awards"
                :key="entry.id"
                :label="`Award #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.name" label="Award Name" span />
                <BuilderField v-model="entry.organization" label="Organization" />
                <BuilderField v-model="entry.date" label="Date" type="month" />
                <BuilderTextarea v-model="entry.description" label="Description" :rows="2" span />
            </RepeaterCard>

            <AddButton label="Add Award" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
