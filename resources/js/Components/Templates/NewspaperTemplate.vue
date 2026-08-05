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
    <div class="bg-white p-10 text-gray-900">
        <header class="border-t-4 border-gray-900 pt-4 text-center">
            <h1 class="font-serif text-3xl font-black tracking-tight text-center">{{ resume.personal.fullName || 'Your Name' }}</h1>
            <p v-if="resume.personal.title" class="mt-1 font-serif text-sm italic text-gray-600 text-center">
                {{ resume.personal.title }}
            </p>
            <p v-if="contactLine.length" class="mt-3 text-xs uppercase tracking-widest text-gray-500 text-center">
                {{ contactLine.join(' · ') }}
            </p>
            <div class="mt-3 border-t border-gray-900"></div>
        </header>

        <div class="mt-6 [column-count:2] gap-8 [column-fill:balance]">
            <section v-if="resume.summary" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Summary</h2>
                <p class="mt-1.5 text-sm leading-relaxed text-gray-700">{{ resume.summary }}</p>
            </section>

            <section v-if="hasExperience" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Experience</h2>
                <div class="mt-2 space-y-3">
                    <div v-for="entry in resume.experience" :key="entry.id">
                        <div v-if="entry.position || entry.company" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ entry.position }}<span v-if="entry.position && entry.company"> · </span>{{ entry.company }}
                            </p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate, entry.current) }}</p>
                        </div>
                        <p v-if="entry.location" class="text-xs text-gray-500">{{ entry.location }}</p>
                        <p v-if="entry.responsibilities" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">
                            {{ entry.responsibilities }}
                        </p>
                        <p v-if="entry.achievements" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">
                            <span class="font-medium text-gray-500">Achievements: </span>{{ entry.achievements }}
                        </p>
                    </div>
                </div>
            </section>

            <section v-if="hasEducation" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Education</h2>
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

            <section v-if="resume.skills.length" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Skills</h2>
                <div class="mt-2 flex flex-wrap gap-1.5">
                    <span v-for="skill in resume.skills" :key="skill" class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                        {{ skill }}
                    </span>
                </div>
            </section>

            <section v-if="hasProjects" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Projects</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.projects" :key="entry.id">
                        <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                            </p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasCertifications" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Certifications</h2>
                <div class="mt-2 space-y-1">
                    <div v-for="entry in resume.certifications" :key="entry.id" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm text-gray-700">
                            {{ entry.name }}<span v-if="entry.organization"> — {{ entry.organization }}</span>
                        </p>
                        <p v-if="entry.date" class="shrink-0 text-xs text-gray-400">{{ formatMonth(entry.date) }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasTrainings" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Trainings & Seminars</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.trainings" :key="entry.id">
                        <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ entry.name }}<span v-if="entry.organizer"> · {{ entry.organizer }}</span>
                            </p>
                            <p v-if="entry.date" class="shrink-0 text-xs text-gray-400">{{ formatMonth(entry.date) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasAwards" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Awards & Achievements</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.awards" :key="entry.id">
                        <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                            </p>
                            <p v-if="entry.date" class="shrink-0 text-xs text-gray-400">{{ formatMonth(entry.date) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasVolunteer" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Volunteer Experience</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="entry in resume.volunteer" :key="entry.id">
                        <div v-if="entry.organization || entry.role" class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ entry.role }}<span v-if="entry.role && entry.organization"> · </span>{{ entry.organization }}
                            </p>
                            <p class="shrink-0 text-xs text-gray-400">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                        </div>
                        <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasLanguages" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">Languages</h2>
                <p class="mt-2 text-sm text-gray-700">
                    {{ resume.languages.filter((entry) => entry.language).map((entry) => (entry.proficiency ? `${entry.language} (${entry.proficiency})` : entry.language)).join(' · ') }}
                </p>
            </section>

            <section v-for="section in visibleCustomSections" :key="section.id" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">{{ section.title || 'Additional Information' }}</h2>
                <div class="mt-2 space-y-2">
                    <div v-for="item in section.items.filter((entry) => entry.title)" :key="item.id">
                        <div class="flex items-baseline justify-between gap-2">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ item.title }}<span v-if="item.subtitle"> · {{ item.subtitle }}</span>
                            </p>
                            <p v-if="item.date" class="shrink-0 text-xs text-gray-400">{{ item.date }}</p>
                        </div>
                        <p v-if="item.description" class="text-sm leading-relaxed text-gray-700">{{ item.description }}</p>
                    </div>
                </div>
            </section>

            <section v-if="hasReferences" class="mt-5 mb-5 break-inside-avoid-column">
                <h2 class="border-b border-gray-900 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900 font-serif">References</h2>
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
