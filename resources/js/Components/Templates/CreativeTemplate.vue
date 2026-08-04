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

const skillColors = ['bg-pink-100 text-pink-700', 'bg-violet-100 text-violet-700', 'bg-teal-100 text-teal-700', 'bg-amber-100 text-amber-700'];
</script>

<template>
    <div class="flex bg-white text-gray-900">
        <div class="w-2 shrink-0 bg-gradient-to-b from-pink-500 via-violet-500 to-teal-400"></div>

        <div class="flex-1 p-9">
            <header class="flex items-center gap-4">
                <img
                    v-if="resume.personal.photo"
                    :src="resume.personal.photo"
                    alt="Profile photo"
                    class="size-20 shrink-0 rounded-full object-cover ring-4 ring-violet-100"
                />
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900">{{ resume.personal.fullName || 'Your Name' }}</h1>
                    <p v-if="resume.personal.title" class="mt-0.5 text-sm font-semibold text-violet-600">{{ resume.personal.title }}</p>
                    <p v-if="contactLine.length" class="mt-2 text-xs text-gray-500">{{ contactLine.join(' · ') }}</p>
                </div>
            </header>

            <section v-if="resume.summary" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">About Me</h2>
                <p class="mt-1.5 text-sm leading-relaxed text-gray-700">{{ resume.summary }}</p>
            </section>

            <section v-if="resume.skills.length" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Skills</h2>
                <div class="mt-2 flex flex-wrap gap-1.5">
                    <span
                        v-for="(skill, index) in resume.skills"
                        :key="skill"
                        class="rounded-full px-2.5 py-0.5 text-xs font-medium"
                        :class="skillColors[index % skillColors.length]"
                    >
                        {{ skill }}
                    </span>
                </div>
            </section>

            <section v-if="hasExperience" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Experience</h2>
                <div class="mt-2 space-y-3">
                    <div v-for="entry in resume.experience" :key="entry.id">
                        <div v-if="entry.position || entry.company" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ entry.position }}<span v-if="entry.position && entry.company"> · </span>{{ entry.company }}
                            </p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate, entry.current) }}</p>
                        </div>
                        <p v-if="entry.location" class="text-xs text-gray-500">{{ entry.location }}</p>
                        <p v-if="entry.responsibilities" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">{{ entry.responsibilities }}</p>
                        <p v-if="entry.achievements" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">
                            <span class="font-medium text-violet-500">Achievements: </span>{{ entry.achievements }}
                        </p>
                    </div>
                </div>
            </section>

            <section v-if="hasEducation" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Education</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.education" :key="entry.id">
                        <div v-if="entry.school || entry.degree" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">{{ entry.school }}</p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                        </div>
                        <p v-if="entry.degree || entry.fieldOfStudy" class="text-xs text-gray-500">
                            {{ entry.degree }}<span v-if="entry.degree && entry.fieldOfStudy">, </span>{{ entry.fieldOfStudy }}
                        </p>
                        <p v-if="entry.description" class="mt-1 text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasProjects" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Projects</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.projects" :key="entry.id">
                        <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">{{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span></p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasCertifications" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Certifications</h2>
                <div class="mt-2 space-y-1">
                    <div v-for="entry in resume.certifications" :key="entry.id" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm text-gray-700">{{ entry.name }}<span v-if="entry.organization"> — {{ entry.organization }}</span></p>
                        <p v-if="entry.date" class="shrink-0 text-xs text-gray-400">{{ formatMonth(entry.date) }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasTrainings" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Trainings & Seminars</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.trainings" :key="entry.id">
                        <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">{{ entry.name }}<span v-if="entry.organizer"> · {{ entry.organizer }}</span></p>
                            <p v-if="entry.date" class="shrink-0 text-xs text-gray-400">{{ formatMonth(entry.date) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasAwards" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Awards & Achievements</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.awards" :key="entry.id">
                        <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">{{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span></p>
                            <p v-if="entry.date" class="shrink-0 text-xs text-gray-400">{{ formatMonth(entry.date) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasVolunteer" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Volunteer Experience</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.volunteer" :key="entry.id">
                        <div v-if="entry.organization || entry.role" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">{{ entry.role }}<span v-if="entry.role && entry.organization"> · </span>{{ entry.organization }}</p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasLanguages" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">Languages</h2>
                <p class="mt-2 text-sm text-gray-700">
                    {{ resume.languages.filter((entry) => entry.language).map((entry) => (entry.proficiency ? `${entry.language} (${entry.proficiency})` : entry.language)).join(' · ') }}
                </p>
            </section>

            <section v-for="section in visibleCustomSections" :key="section.id" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">{{ section.title || 'Additional Information' }}</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="item in section.items.filter((entry) => entry.title)" :key="item.id">
                        <div class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">{{ item.title }}<span v-if="item.subtitle"> · {{ item.subtitle }}</span></p>
                            <p v-if="item.date" class="shrink-0 text-xs text-gray-400">{{ item.date }}</p>
                        </div>
                        <p v-if="item.description" class="text-sm leading-relaxed text-gray-700">{{ item.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasReferences" class="mt-6">
                <h2 class="text-xs font-bold uppercase tracking-wide text-violet-500">References</h2>
                <div class="mt-2 space-y-1">
                    <p v-for="entry in resume.references" :key="entry.id" class="text-sm text-gray-700">
                        {{ entry.name }}<span v-if="entry.position || entry.company">, {{ [entry.position, entry.company].filter(Boolean).join(', ') }}</span
                        ><span v-if="entry.contactNumber || entry.email"> — {{ [entry.contactNumber, entry.email].filter(Boolean).join(' · ') }}</span>
                    </p>
                </div>
            </section>
        </div>
    </div>
</template>
