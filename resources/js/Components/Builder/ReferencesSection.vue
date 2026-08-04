<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import RepeaterCard from '@/Components/Builder/RepeaterCard.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    references: { type: Array, required: true },
});

defineEmits(['add', 'remove']);
</script>

<template>
    <BuilderSection title="References" optional>
        <div class="space-y-4">
            <RepeaterCard
                v-for="(entry, index) in references"
                :key="entry.id"
                :label="`Reference #${index + 1}`"
                @remove="$emit('remove', entry.id)"
            >
                <BuilderField v-model="entry.name" label="Name" />
                <BuilderField v-model="entry.position" label="Position" />
                <BuilderField v-model="entry.company" label="Company" />
                <BuilderField v-model="entry.contactNumber" label="Contact Number" type="tel" />
                <BuilderField v-model="entry.email" label="Email Address" type="email" span />
            </RepeaterCard>

            <AddButton label="Add Reference" @click="$emit('add')" />
        </div>
    </BuilderSection>
</template>
