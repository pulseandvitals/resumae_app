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
    <div class="grid grid-cols-5 bg-white text-gray-900">
        <!-- Sidebar -->
        <aside class="col-span-2 space-y-5 bg-slate-800 p-6 text-slate-100">
            <div>
                <img
                    v-if="resume.personal.photo"
                    :src="resume.personal.photo"
                    alt="Profile photo"
                    class="mb-3 size-16 rounded-full object-cover ring-2 ring-slate-600"
                />
                <h1 class="text-lg font-bold leading-tight">{{ resume.personal.fullName || 'Your Name' }}</h1>
                <p v-if="resume.personal.title" class="mt-1 text-xs text-slate-300">{{ resume.personal.title }}</p>
            </div>

            <div v-if="contactLine.length">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Contact</h2>
                <ul class="mt-2 space-y-1 text-xs text-slate-300">
                    <li v-for="item in contactLine" :key="item" class="break-words">{{ item }}</li>
                </ul>
            </div>

            <div v-if="resume.skills.length">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Skills</h2>
                <div class="mt-2 flex flex-wrap gap-1">
                    <span v-for="skill in resume.skills" :key="skill" class="rounded bg-slate-700 px-2 py-0.5 text-[11px] text-slate-100">
                        {{ skill }}
                    </span>
                </div>
            </div>

            <div v-if="hasLanguages">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Languages</h2>
                <ul class="mt-2 space-y-0.5 text-xs text-slate-300">
                    <li v-for="entry in resume.languages.filter((e) => e.language)" :key="entry.id">
                        {{ entry.language }}<span v-if="entry.proficiency"> — {{ entry.proficiency }}</span>
                    </li>
                </ul>
            </div>

            <div v-if="hasCertifications">
                <h2 class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Certifications</h2>
                <ul class="mt-2 space-y-1 text-xs text-slate-300">
                    <li v-for="entry in resume.certifications.filter((e) => e.name)" :key="entry.id">
                        {{ entry.name }}<span v-if="entry.organization"> — {{ entry.organization }}</span>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main -->
        <main class="col-span-3 space-y-5 p-6">
            <section v-if="resume.summary">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Summary</h2>
                <p class="mt-1.5 text-sm leading-relaxed text-gray-700">{{ resume.summary }}</p>
            </section>

            <section v-if="hasExperience">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Experience</h2>
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
                            <span class="font-medium text-gray-500">Achievements: </span>{{ entry.achievements }}
                        </p>
                    </div>
                </div>
            </section>

            <section v-if="hasEducation">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Education</h2>
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

            <section v-if="hasProjects">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Projects</h2>
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

            <section v-if="hasTrainings">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Trainings & Seminars</h2>
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

            <section v-if="hasAwards">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Awards & Achievements</h2>
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

            <section v-if="hasVolunteer">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">Volunteer Experience</h2>
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

            <section v-for="section in visibleCustomSections" :key="section.id">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">{{ section.title || 'Additional Information' }}</h2>
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

            <section v-if="hasReferences">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-600">References</h2>
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
