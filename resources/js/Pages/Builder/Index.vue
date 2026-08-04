<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { useResumeBuilder } from '@/Composables/useResumeBuilder';
import { useSelectedTemplate } from '@/Composables/useSelectedTemplate';

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
import PaymentModal from '@/Components/Builder/PaymentModal.vue';

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

const mobileTab = ref('edit');
const showPaymentModal = ref(false);
</script>

<template>
    <Head title="Build Your Resume" />

    <div class="min-h-screen bg-gray-50">
        <header class="sticky top-0 z-10 border-b border-gray-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-3">
                <Link :href="route('home')" class="text-base font-bold tracking-tight text-gray-900">
                    Resum<span class="text-indigo-600">AE</span>
                </Link>

                <div class="flex items-center gap-3">
                    <div class="flex rounded-md bg-gray-100 p-1 lg:hidden">
                        <button
                            type="button"
                            class="rounded px-3 py-1 text-sm font-medium transition"
                            :class="mobileTab === 'edit' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500'"
                            @click="mobileTab = 'edit'"
                        >
                            Edit
                        </button>
                        <button
                            type="button"
                            class="rounded px-3 py-1 text-sm font-medium transition"
                            :class="mobileTab === 'preview' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500'"
                            @click="mobileTab = 'preview'"
                        >
                            Preview
                        </button>
                    </div>

                    <button
                        type="button"
                        class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
                        @click="showPaymentModal = true"
                    >
                        Download PDF<span v-if="selectedTemplate"> · ₱{{ Number(selectedTemplate.price).toFixed(0) }}</span>
                    </button>
                </div>
            </div>
        </header>

        <main class="mx-auto grid max-w-7xl gap-8 px-6 py-8 lg:grid-cols-2">
            <!-- Form -->
            <div
                class="rounded-lg bg-white px-6 py-2 shadow-sm ring-1 ring-gray-900/5"
                :class="mobileTab === 'edit' ? 'block' : 'hidden lg:block'"
            >
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
                <ProjectsSection
                    :projects="resume.projects"
                    @add="addProject"
                    @remove="removeProject"
                />
                <CertificationsSection
                    :certifications="resume.certifications"
                    @add="addCertification"
                    @remove="removeCertification"
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

            <!-- Live Preview -->
            <div
                class="space-y-4 lg:sticky lg:top-20 lg:self-start"
                :class="mobileTab === 'preview' ? 'block' : 'hidden lg:block'"
            >
                <div v-if="templates.length" class="rounded-lg bg-white p-3 shadow-sm ring-1 ring-gray-900/5">
                    <p class="mb-2 px-1 text-xs font-semibold uppercase tracking-wide text-gray-400">Template</p>
                    <TemplatePicker
                        :templates="templates"
                        :selected-key="selectedKey"
                        @select="selectedKey = $event"
                    />
                </div>

                <TemplateRenderer
                    :template-key="selectedKey"
                    :resume="resume"
                    :class="{ 'blur-sm': showPaymentModal }"
                />
            </div>
        </main>

        <PaymentModal
            :show="showPaymentModal"
            :template="selectedTemplate"
            @close="showPaymentModal = false"
        />
    </div>
</template>
