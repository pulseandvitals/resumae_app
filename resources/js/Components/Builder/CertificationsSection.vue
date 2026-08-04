<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    certifications: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="Certifications" optional>
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in certifications"
                :key="entry.id"
                :label="`Certification #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.name" label="Certificate Name" span />
                <BuilderField v-model="entry.organization" label="Issuing Organization" />
                <BuilderField v-model="entry.date" label="Date Issued" type="month" />
            </RepeaterCard>

            <AddButton label="Add Certification" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
