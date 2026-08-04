<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';

const summary = defineModel({ type: String, required: true });
</script>

<template>
    <BuilderSection
        title="Professional Summary"
        description="A short introduction about yourself."
    >
        <BuilderTextarea
            v-model="summary"
            label="Summary"
            placeholder="e.g. Frontend developer with 3 years of experience building responsive web apps with Vue and Tailwind."
            :rows="4"
        />
    </BuilderSection>
</template>
