<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import PhotoUpload from '@/Components/Builder/PhotoUpload.vue';

const personal = defineModel({ type: Object, required: true });
</script>

<template>
    <BuilderSection
        title="Personal Information"
        description="How employers will identify and reach you."
    >
        <div class="mb-4">
            <PhotoUpload v-model="personal.photo" />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <BuilderField v-model="personal.fullName" label="Full Name" required />
            <BuilderField v-model="personal.title" label="Professional Title" placeholder="e.g. Frontend Developer" />
            <BuilderField v-model="personal.email" label="Email Address" type="email" required />
            <BuilderField v-model="personal.phone" label="Phone Number" type="tel" />
            <BuilderField v-model="personal.address" label="Address" span />
            <BuilderField v-model="personal.website" label="Personal Website" type="url" placeholder="Optional" />
            <BuilderField
                v-model="personal.profileLink"
                label="Professional Profile Link"
                type="url"
                placeholder="e.g. LinkedIn (Optional)"
            />
        </div>
    </BuilderSection>
</template>
