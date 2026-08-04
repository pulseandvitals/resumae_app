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
    <div class="bg-white p-10 font-serif text-gray-900">
        <header class="border-b-2 border-gray-800 pb-4 text-center">
            <img
                v-if="resume.personal.photo"
                :src="resume.personal.photo"
                alt="Profile photo"
                class="mx-auto mb-3 size-16 rounded-full object-cover"
            />
            <h1 class="text-3xl font-bold tracking-wide">{{ resume.personal.fullName || 'Your Name' }}</h1>
            <p v-if="resume.personal.title" class="mt-1 text-sm italic text-gray-600">{{ resume.personal.title }}</p>
            <p v-if="contactLine.length" class="mt-2 text-xs text-gray-500">{{ contactLine.join('  |  ') }}</p>
        </header>

        <section v-if="resume.summary" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Summary</h2>
            <p class="mt-2 text-sm leading-relaxed text-gray-700">{{ resume.summary }}</p>
        </section>

        <section v-if="hasExperience" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Experience</h2>
            <div class="mt-2 space-y-3">
                <div v-for="entry in resume.experience" :key="entry.id">
                    <div v-if="entry.position || entry.company" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">
                            {{ entry.position }}<span v-if="entry.position && entry.company">, </span>{{ entry.company }}
                        </p>
                        <p class="shrink-0 text-xs italic text-gray-500">{{ dateRange(entry.startDate, entry.endDate, entry.current) }}</p>
                    </div>
                    <p v-if="entry.location" class="text-xs italic text-gray-500">{{ entry.location }}</p>
                    <p v-if="entry.responsibilities" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">{{ entry.responsibilities }}</p>
                    <p v-if="entry.achievements" class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-700">
                        <span class="font-semibold">Achievements: </span>{{ entry.achievements }}
                    </p>
                </div>
            </div>
        </section>

        <section v-if="hasEducation" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Education</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.education" :key="entry.id">
                    <div v-if="entry.school || entry.degree" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">{{ entry.school }}</p>
                        <p class="shrink-0 text-xs italic text-gray-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.degree || entry.fieldOfStudy" class="text-xs text-gray-600">
                        {{ entry.degree }}<span v-if="entry.degree && entry.fieldOfStudy">, </span>{{ entry.fieldOfStudy }}
                    </p>
                    <p v-if="entry.description" class="mt-1 text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="resume.skills.length" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Skills</h2>
            <p class="mt-2 text-sm text-gray-700">{{ resume.skills.join('  •  ') }}</p>
        </section>

        <section v-if="hasProjects" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Projects</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.projects" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">{{ entry.name }}<span v-if="entry.organization">, {{ entry.organization }}</span></p>
                        <p class="shrink-0 text-xs italic text-gray-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasCertifications" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Certifications</h2>
            <div class="mt-2 space-y-1">
                <div v-for="entry in resume.certifications" :key="entry.id" class="flex items-baseline justify-between gap-2">
                    <p class="text-sm text-gray-700">{{ entry.name }}<span v-if="entry.organization">, {{ entry.organization }}</span></p>
                    <p v-if="entry.date" class="shrink-0 text-xs italic text-gray-500">{{ formatMonth(entry.date) }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasTrainings" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Trainings & Seminars</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.trainings" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">{{ entry.name }}<span v-if="entry.organizer">, {{ entry.organizer }}</span></p>
                        <p v-if="entry.date" class="shrink-0 text-xs italic text-gray-500">{{ formatMonth(entry.date) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasAwards" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Awards & Achievements</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.awards" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">{{ entry.name }}<span v-if="entry.organization">, {{ entry.organization }}</span></p>
                        <p v-if="entry.date" class="shrink-0 text-xs italic text-gray-500">{{ formatMonth(entry.date) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasVolunteer" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Volunteer Experience</h2>
            <div class="mt-2 space-y-2">
                <div v-for="entry in resume.volunteer" :key="entry.id">
                    <div v-if="entry.organization || entry.role" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">{{ entry.role }}<span v-if="entry.role && entry.organization">, </span>{{ entry.organization }}</p>
                        <p class="shrink-0 text-xs italic text-gray-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-relaxed text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasLanguages" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">Languages</h2>
            <p class="mt-2 text-sm text-gray-700">
                {{ resume.languages.filter((entry) => entry.language).map((entry) => (entry.proficiency ? `${entry.language} (${entry.proficiency})` : entry.language)).join('  •  ') }}
            </p>
        </section>

        <section v-for="section in visibleCustomSections" :key="section.id" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">{{ section.title || 'Additional Information' }}</h2>
            <div class="mt-2 space-y-2">
                <div v-for="item in section.items.filter((entry) => entry.title)" :key="item.id">
                    <div class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-bold text-gray-900">{{ item.title }}<span v-if="item.subtitle">, {{ item.subtitle }}</span></p>
                        <p v-if="item.date" class="shrink-0 text-xs italic text-gray-500">{{ item.date }}</p>
                    </div>
                    <p v-if="item.description" class="text-sm leading-relaxed text-gray-700">{{ item.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasReferences" class="mt-5">
            <h2 class="border-b border-gray-300 pb-1 text-sm font-bold uppercase tracking-widest text-gray-800">References</h2>
            <div class="mt-2 space-y-1">
                <p v-for="entry in resume.references" :key="entry.id" class="text-sm text-gray-700">
                    {{ entry.name }}<span v-if="entry.position || entry.company">, {{ [entry.position, entry.company].filter(Boolean).join(', ') }}</span
                    ><span v-if="entry.contactNumber || entry.email"> — {{ [entry.contactNumber, entry.email].filter(Boolean).join(', ') }}</span>
                </p>
            </div>
        </section>
    </div>
</template>
