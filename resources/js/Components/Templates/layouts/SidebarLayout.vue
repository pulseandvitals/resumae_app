<script setup>
import { formatMonth, dateRange, useResumePreviewData } from '@/Composables/useResumePreviewData';

const props = defineProps({
    resume: { type: Object, required: true },
    theme: { type: Object, required: true },
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
    <div class="flex min-h-full bg-white text-gray-900">
        <aside class="w-[34%] shrink-0 p-6" :class="theme.bg">
            <img
                v-if="resume.personal.photo"
                :src="resume.personal.photo"
                alt="Profile photo"
                class="size-20 rounded-full object-cover ring-2 ring-white/40"
            />
            <h1 class="mt-4 text-xl font-bold tracking-tight" :class="theme.textOnBg">{{ resume.personal.fullName || 'Your Name' }}</h1>
            <p v-if="resume.personal.title" class="mt-1 text-sm font-medium" :class="theme.chipText">
                {{ resume.personal.title }}
            </p>

            <div v-if="contactLine.length" class="mt-4 space-y-1">
                <p v-for="item in contactLine" :key="item" class="text-xs leading-relaxed" :class="theme.textOnBg">{{ item }}</p>
            </div>

            <div v-if="resume.skills.length" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide" :class="theme.chipText">Skills</h2>
                <div class="mt-2 flex flex-wrap gap-1.5">
                    <span
                        v-for="skill in resume.skills"
                        :key="skill"
                        class="rounded-full px-2.5 py-0.5 text-xs font-medium"
                        :class="[theme.textOnBg, 'bg-white/10']"
                    >
                        {{ skill }}
                    </span>
                </div>
            </div>

            <div v-if="hasLanguages" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide" :class="theme.chipText">Languages</h2>
                <p class="mt-2 text-xs leading-relaxed" :class="theme.textOnBg">
                    {{ resume.languages.filter((entry) => entry.language).map((entry) => (entry.proficiency ? `${entry.language} (${entry.proficiency})` : entry.language)).join(' · ') }}
                </p>
            </div>

            <div v-if="hasCertifications" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide" :class="theme.chipText">Certifications</h2>
                <div class="mt-2 space-y-1.5">
                    <p v-for="entry in resume.certifications" :key="entry.id" class="text-xs leading-relaxed" :class="theme.textOnBg">
                        {{ entry.name }}<span v-if="entry.organization"> — {{ entry.organization }}</span>
                    </p>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-8">
            <section v-if="resume.summary">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Summary</h2>
                <p class="mt-1.5 text-sm leading-relaxed text-gray-700">{{ resume.summary }}</p>
            </section>

            <section v-if="hasExperience" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Experience</h2>
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

            <section v-if="hasEducation" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Education</h2>
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

            <section v-if="hasProjects" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Projects</h2>
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

            <section v-if="hasTrainings" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Trainings & Seminars</h2>
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

            <section v-if="hasAwards" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Awards & Achievements</h2>
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

            <section v-if="hasVolunteer" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">Volunteer Experience</h2>
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

            <section v-for="section in visibleCustomSections" :key="section.id" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">{{ section.title || 'Additional Information' }}</h2>
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

            <section v-if="hasReferences" class="mt-5">
                <h2 class="text-xs font-bold uppercase tracking-wide text-gray-400">References</h2>
                <div class="mt-2 space-y-1">
                    <p v-for="entry in resume.references" :key="entry.id" class="text-sm text-gray-700">
                        {{ entry.name }}<span v-if="entry.position || entry.company">, {{ [entry.position, entry.company].filter(Boolean).join(', ') }}</span
                        ><span v-if="entry.contactNumber || entry.email"> — {{ [entry.contactNumber, entry.email].filter(Boolean).join(' · ') }}</span>
                    </p>
                </div>
            </section>
        </main>
    </div>
</template>
