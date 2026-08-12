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
    <div class="bg-amber-50 p-10 font-mono text-stone-800">
        <header class="border-b border-stone-300 pb-4 text-center">
            <img
                v-if="resume.personal.photo"
                :src="resume.personal.photo"
                alt="Profile photo"
                class="mx-auto size-16 shrink-0 rounded-full object-cover"
            />
            <h1 class="mt-2 text-2xl font-bold uppercase tracking-widest text-stone-900 text-center">{{ resume.personal.fullName || 'Your Name' }}</h1>
            <div class="mx-auto mt-2 h-0.5 w-16 bg-stone-400"></div>
            <div class="mx-auto mt-1 h-px w-16 bg-stone-400"></div>
            <p v-if="resume.personal.title" class="mt-2 text-sm text-stone-600 text-center">
                {{ resume.personal.title }}
            </p>
            <p v-if="contactLine.length" class="mt-2 text-xs leading-relaxed text-stone-500 text-center">
                {{ contactLine.join(' · ') }}
            </p>
        </header>

        <section v-if="resume.summary" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Summary</h2>
            <p class="mt-1.5 text-sm leading-relaxed text-stone-700">{{ resume.summary }}</p>
        </section>

        <section v-if="hasExperience" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Experience</h2>
            <div class="mt-2 space-y-3">
                <div v-for="entry in resume.experience" :key="entry.id">
                    <div v-if="entry.position || entry.company" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">
                            {{ entry.position }}<span v-if="entry.position && entry.company"> · </span>{{ entry.company }}
                        </p>
                        <p class="shrink-0 text-xs text-stone-500">{{ dateRange(entry.startDate, entry.endDate, entry.current) }}</p>
                    </div>
                    <p v-if="entry.location" class="text-xs text-stone-500">{{ entry.location }}</p>
                    <p v-if="entry.responsibilities" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-stone-700">
                        {{ entry.responsibilities }}
                    </p>
                    <p v-if="entry.achievements" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-stone-700">
                        <span class="font-medium text-stone-500">Achievements: </span>{{ entry.achievements }}
                    </p>
                </div>
            </div>
        </section>

        <section v-if="hasEducation" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Education</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.education" :key="entry.id">
                    <div v-if="entry.school || entry.degree" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">{{ entry.school }}</p>
                        <p class="shrink-0 text-xs text-stone-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.degree || entry.fieldOfStudy" class="text-xs text-stone-500">
                        {{ entry.degree }}<span v-if="entry.degree && entry.fieldOfStudy">, </span>{{ entry.fieldOfStudy }}
                    </p>
                    <p v-if="entry.description" class="mt-1 text-sm leading-relaxed text-stone-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="resume.skills.length" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Skills</h2>
            <div class="mt-2 flex flex-wrap gap-1.5">
                <span v-for="skill in resume.skills" :key="skill" class="rounded border border-stone-400 bg-transparent px-2.5 py-0.5 text-xs font-medium text-stone-700">
                    {{ skill }}
                </span>
            </div>
        </section>

        <section v-if="hasProjects" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Projects</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.projects" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">
                            {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                        </p>
                        <p class="shrink-0 text-xs text-stone-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-stone-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasCertifications" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Certifications</h2>
            <div class="mt-2 space-y-1">
                <div v-for="entry in resume.certifications" :key="entry.id" class="flex items-baseline justify-between gap-2">
                    <p class="text-sm text-stone-700">
                        {{ entry.name }}<span v-if="entry.organization"> — {{ entry.organization }}</span>
                    </p>
                    <p v-if="entry.date" class="shrink-0 text-xs text-stone-500">{{ formatMonth(entry.date) }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasTrainings" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Trainings & Seminars</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.trainings" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">
                            {{ entry.name }}<span v-if="entry.organizer"> · {{ entry.organizer }}</span>
                        </p>
                        <p v-if="entry.date" class="shrink-0 text-xs text-stone-500">{{ formatMonth(entry.date) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-stone-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasAwards" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Awards & Achievements</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.awards" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">
                            {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                        </p>
                        <p v-if="entry.date" class="shrink-0 text-xs text-stone-500">{{ formatMonth(entry.date) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-stone-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasVolunteer" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Volunteer Experience</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.volunteer" :key="entry.id">
                    <div v-if="entry.organization || entry.role" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">
                            {{ entry.role }}<span v-if="entry.role && entry.organization"> · </span>{{ entry.organization }}
                        </p>
                        <p class="shrink-0 text-xs text-stone-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-stone-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasLanguages" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">Languages</h2>
            <p class="mt-2 text-sm text-stone-700">
                {{ resume.languages.filter((entry) => entry.language).map((entry) => (entry.proficiency ? `${entry.language} (${entry.proficiency})` : entry.language)).join(' · ') }}
            </p>
        </section>

        <section v-for="section in visibleCustomSections" :key="section.id" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">{{ section.title || 'Additional Information' }}</h2>
            <div class="mt-2 space-y-2">
                <div v-for="item in section.items.filter((entry) => entry.title)" :key="item.id">
                    <div class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-stone-900">
                            {{ item.title }}<span v-if="item.subtitle"> · {{ item.subtitle }}</span>
                        </p>
                        <p v-if="item.date" class="shrink-0 text-xs text-stone-500">{{ item.date }}</p>
                    </div>
                    <p v-if="item.description" class="text-sm leading-relaxed text-stone-700">{{ item.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasReferences" class="mt-5">
            <h2 class="text-xs font-bold uppercase tracking-widest text-stone-700 border-b border-stone-300 pb-1">References</h2>
            <div class="mt-2 space-y-1">
                <p v-for="entry in resume.references" :key="entry.id" class="text-sm text-stone-700">
                    {{ entry.name }}<span v-if="entry.position || entry.company">, {{ [entry.position, entry.company].filter(Boolean).join(', ') }}</span
                    ><span v-if="entry.contactNumber || entry.email"> — {{ [entry.contactNumber, entry.email].filter(Boolean).join(' · ') }}</span>
                </p>
            </div>
        </section>
    </div>
</template>
