<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { useResumeBuilder } from '@/Composables/useResumeBuilder';
import { useSelectedTemplate } from '@/Composables/useSelectedTemplate';
import { useRecommendedTemplates } from '@/Composables/useRecommendedTemplates';

import PersonalInfoSection from '@/Components/Builder/PersonalInfoSection.vue';
import SummarySection from '@/Components/Builder/SummarySection.vue';
import ExperienceSection from '@/Components/Builder/ExperienceSection.vue';
import EducationSection from '@/Components/Builder/EducationSection.vue';
import SkillsSection from '@/Components/Builder/SkillsSection.vue';
import ProjectsSection from '@/Components/Builder/ProjectsSection.vue';
import CertificationsSection from '@/Components/Builder/CertificationsSection.vue';
import TrainingsSection from '@/Components/Builder/TrainingsSection.vue';
import AwardsSection from '@/Components/Builder/AwardsSection.vue';
import VolunteerSection from '@/Components/Builder/VolunteerSection.vue';
import LanguagesSection from '@/Components/Builder/LanguagesSection.vue';
import ReferencesSection from '@/Components/Builder/ReferencesSection.vue';
import CustomSection from '@/Components/Builder/CustomSection.vue';
import TemplateRenderer from '@/Components/Templates/TemplateRenderer.vue';
import TemplatePicker from '@/Components/Builder/TemplatePicker.vue';
import DownloadPanel from '@/Components/Builder/DownloadPanel.vue';
import StepIndicator from '@/Components/Builder/StepIndicator.vue';

const props = defineProps({
    templates: { type: Array, default: () => [] },
});

const { selectedKey } = useSelectedTemplate(props.templates);
const selectedTemplate = computed(() =>
    props.templates.find((template) => template.key === selectedKey.value) ?? null,
);

const requestedKey = new URLSearchParams(window.location.search).get('template');
if (requestedKey && props.templates.some((template) => template.key === requestedKey)) {
    selectedKey.value = requestedKey;
}

const {
    resume,
    addExperience,
    removeExperience,
    addEducation,
    removeEducation,
    addSkill,
    removeSkill,
    addProject,
    removeProject,
    addCertification,
    removeCertification,
    addTraining,
    removeTraining,
    addAward,
    removeAward,
    addVolunteer,
    removeVolunteer,
    addLanguage,
    removeLanguage,
    addReference,
    removeReference,
    addCustomSection,
    removeCustomSection,
    addCustomItem,
    removeCustomItem,
} = useResumeBuilder();

const recommendedKeys = useRecommendedTemplates(
    computed(() => props.templates),
    computed(() => resume.skills),
);

const steps = [
    { id: 1, label: 'Information' },
    { id: 2, label: 'Template' },
    { id: 3, label: 'Download' },
];

const currentStep = ref(1);
// Returning visitors (localStorage already has a name) can jump straight in.
const maxStepReached = ref(resume.personal.fullName ? steps.length : 1);

const canContinueFromStep1 = computed(() => resume.personal.fullName.trim().length > 0);

function goToStep(id) {
    if (id > maxStepReached.value) return;
    currentStep.value = id;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function nextStep() {
    const next = Math.min(currentStep.value + 1, steps.length);
    maxStepReached.value = Math.max(maxStepReached.value, next);
    currentStep.value = next;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<template>
    <Head title="Build Your Resume" />

    <div class="min-h-screen bg-gray-50">
        <header class="sticky top-0 z-10 border-b border-gray-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-3 sm:flex-row sm:items-center sm:justify-between">
                <Link :href="route('home')" class="text-base font-bold tracking-tight text-gray-900">
                    Resum<span class="text-indigo-600">AE</span>
                </Link>

                <StepIndicator
                    :steps="steps"
                    :current-step="currentStep"
                    :max-step-reached="maxStepReached"
                    @go="goToStep"
                />

                <div class="hidden sm:block sm:w-[88px]"></div>
            </div>
        </header>

        <main class="mx-auto max-w-5xl px-6 py-10">
            <!-- Step 1: Information -->
            <div v-if="currentStep === 1">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Enter your information</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Fill in as much as you'd like — optional sections can stay empty.
                    </p>
                </div>

                <div class="rounded-lg bg-white px-6 py-2 shadow-sm ring-1 ring-gray-900/5">
                    <PersonalInfoSection v-model="resume.personal" />
                    <SummarySection v-model="resume.summary" />
                    <ExperienceSection
                        :experience="resume.experience"
                        @add="addExperience"
                        @remove="removeExperience"
                    />
                    <EducationSection
                        :education="resume.education"
                        @add="addEducation"
                        @remove="removeEducation"
                    />
                    <SkillsSection :skills="resume.skills" @add="addSkill" @remove="removeSkill" />
                    <CertificationsSection
                        :certifications="resume.certifications"
                        @add="addCertification"
                        @remove="removeCertification"
                    />
                    <ProjectsSection
                        :projects="resume.projects"
                        @add="addProject"
                        @remove="removeProject"
                    />
                    <TrainingsSection
                        :trainings="resume.trainings"
                        @add="addTraining"
                        @remove="removeTraining"
                    />
                    <AwardsSection :awards="resume.awards" @add="addAward" @remove="removeAward" />
                    <VolunteerSection
                        :volunteer="resume.volunteer"
                        @add="addVolunteer"
                        @remove="removeVolunteer"
                    />
                    <LanguagesSection
                        :languages="resume.languages"
                        @add="addLanguage"
                        @remove="removeLanguage"
                    />
                    <ReferencesSection
                        :references="resume.references"
                        @add="addReference"
                        @remove="removeReference"
                    />
                    <CustomSection
                        :custom-sections="resume.customSections"
                        @add-section="addCustomSection"
                        @remove-section="removeCustomSection"
                        @add-item="addCustomItem"
                        @remove-item="removeCustomItem"
                    />
                </div>

                <div class="mt-6 flex items-center justify-end gap-3">
                    <p v-if="!canContinueFromStep1" class="text-sm text-gray-400">
                        Add your full name to continue.
                    </p>
                    <button
                        type="button"
                        class="rounded-md bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-40"
                        :disabled="!canContinueFromStep1"
                        @click="nextStep"
                    >
                        Continue to Template &rarr;
                    </button>
                </div>
            </div>

            <!-- Step 2: Template & Preview -->
            <div v-else-if="currentStep === 2">
                <div class="mb-6 text-center">
                    <h1 class="text-2xl font-bold text-gray-900">Choose a template</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Pick a design — your live preview updates instantly below.
                    </p>
                </div>

                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-900/5">
                    <TemplatePicker
                        :templates="templates"
                        :selected-key="selectedKey"
                        :recommended-keys="recommendedKeys"
                        @select="selectedKey = $event"
                    />
                </div>

                <div class="mt-6">
                    <TemplateRenderer :template-key="selectedKey" :resume="resume" />
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <button
                        type="button"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900"
                        @click="goToStep(1)"
                    >
                        &larr; Edit information
                    </button>
                    <button
                        type="button"
                        class="rounded-md bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
                        @click="nextStep"
                    >
                        Continue to Download &rarr;
                    </button>
                </div>
            </div>

            <!-- Step 3: Download -->
            <div v-else-if="currentStep === 3">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Download your resume</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Generate a high-quality, print-ready PDF of your resume.
                    </p>
                </div>

                <DownloadPanel :resume="resume" :template="selectedTemplate" />

                <div class="mt-8">
                    <button
                        type="button"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900"
                        @click="goToStep(2)"
                    >
                        &larr; Back to template
                    </button>
                </div>
            </div>
        </main>
    </div>
</template>
