<script setup>
import { formatMonth, dateRange, useResumePreviewData } from '@/Composables/useResumePreviewData';

const props = defineProps({
    resume: { type: Object, required: true },
});

const {
    contactLine,
    hasExperience,
    hasEducation,
    hasProjects,
    hasCertifications,
    hasTrainings,
    hasAwards,
    hasVolunteer,
    hasLanguages,
    hasReferences,
    visibleCustomSections,
} = useResumePreviewData(props.resume);
</script>

<template>
    <div class="bg-white p-7 text-[13px] leading-snug text-gray-900">
        <header class="flex items-center gap-3 border-b border-gray-300 pb-2">
            <img
                v-if="resume.personal.photo"
                :src="resume.personal.photo"
                alt="Profile photo"
                class="size-11 shrink-0 rounded-full object-cover"
            />
            <div>
                <h1 class="text-base font-bold leading-tight text-gray-900">{{ resume.personal.fullName || 'Your Name' }}</h1>
                <p class="text-[11px] text-gray-500">
                    <span v-if="resume.personal.title">{{ resume.personal.title }} · </span>{{ contactLine.join(' · ') }}
                </p>
            </div>
        </header>

        <section v-if="resume.summary" class="mt-2">
            <p class="text-[12px] leading-snug text-gray-700">{{ resume.summary }}</p>
        </section>

        <div class="mt-2 grid grid-cols-2 gap-x-4">
            <section v-if="resume.skills.length">
                <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Skills</h2>
                <p class="text-[11px] text-gray-700">{{ resume.skills.join(', ') }}</p>
            </section>
            <section v-if="hasLanguages">
                <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Languages</h2>
                <p class="text-[11px] text-gray-700">
                    {{ resume.languages.filter((e) => e.language).map((e) => (e.proficiency ? `${e.language} (${e.proficiency})` : e.language)).join(', ') }}
                </p>
            </section>
        </div>

        <section v-if="hasExperience" class="mt-2">
            <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Experience</h2>
            <div class="mt-1 space-y-1.5">
                <div v-for="entry in resume.experience" :key="entry.id">
                    <div v-if="entry.position || entry.company" class="flex items-baseline justify-between gap-2">
                        <p class="text-[12px] font-semibold text-gray-900">
                            {{ entry.position }}<span v-if="entry.position && entry.company"> · </span>{{ entry.company }}<span v-if="entry.location"> · {{ entry.location }}</span>
                        </p>
                        <p class="shrink-0 text-[10px] text-gray-400">{{ dateRange(entry.startDate, entry.endDate, entry.current) }}</p>
                    </div>
                    <p v-if="entry.responsibilities" class="whitespace-pre-line text-[11px] leading-snug text-gray-600">{{ entry.responsibilities }}</p>
                    <p v-if="entry.achievements" class="whitespace-pre-line text-[11px] leading-snug text-gray-600">{{ entry.achievements }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasEducation" class="mt-2">
            <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Education</h2>
            <div class="mt-1 space-y-1">
                <div v-for="entry in resume.education" :key="entry.id">
                    <div v-if="entry.school || entry.degree" class="flex items-baseline justify-between gap-2">
                        <p class="text-[12px] font-semibold text-gray-900">
                            {{ entry.school }}<span v-if="entry.degree"> — {{ entry.degree }}</span><span v-if="entry.fieldOfStudy">, {{ entry.fieldOfStudy }}</span>
                        </p>
                        <p class="shrink-0 text-[10px] text-gray-400">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="hasProjects" class="mt-2">
            <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Projects</h2>
            <div class="mt-1 space-y-1">
                <div v-for="entry in resume.projects" :key="entry.id">
                    <p v-if="entry.name" class="text-[12px] font-semibold text-gray-900">
                        {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                    </p>
                    <p v-if="entry.description" class="text-[11px] leading-snug text-gray-600">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <div class="mt-2 grid grid-cols-2 gap-x-4">
            <section v-if="hasCertifications">
                <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Certifications</h2>
                <p class="text-[11px] text-gray-700">
                    {{ resume.certifications.filter((e) => e.name).map((e) => e.name).join(', ') }}
                </p>
            </section>
            <section v-if="hasTrainings">
                <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Trainings</h2>
                <p class="text-[11px] text-gray-700">
                    {{ resume.trainings.filter((e) => e.name).map((e) => e.name).join(', ') }}
                </p>
            </section>
            <section v-if="hasAwards">
                <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Awards</h2>
                <p class="text-[11px] text-gray-700">
                    {{ resume.awards.filter((e) => e.name).map((e) => e.name).join(', ') }}
                </p>
            </section>
            <section v-if="hasVolunteer">
                <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">Volunteer</h2>
                <p class="text-[11px] text-gray-700">
                    {{ resume.volunteer.filter((e) => e.organization || e.role).map((e) => [e.role, e.organization].filter(Boolean).join(', ')).join('; ') }}
                </p>
            </section>
        </div>

        <section v-for="section in visibleCustomSections" :key="section.id" class="mt-2">
            <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">{{ section.title || 'Additional Information' }}</h2>
            <p class="text-[11px] text-gray-700">
                {{ section.items.filter((e) => e.title).map((e) => e.title).join(', ') }}
            </p>
        </section>

        <section v-if="hasReferences" class="mt-2">
            <h2 class="text-[10px] font-bold uppercase tracking-wide text-gray-400">References</h2>
            <p class="text-[11px] text-gray-700">
                <template v-for="(entry, index) in resume.references" :key="entry.id">
                    <span v-if="index > 0">; </span>{{ entry.name }}<span v-if="entry.company"> ({{ entry.company }})</span>
                </template>
            </p>
        </section>
    </div>
</template>
