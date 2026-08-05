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

function toRoman(num) {
    const table = [
        [1000, 'M'], [900, 'CM'], [500, 'D'], [400, 'CD'],
        [100, 'C'], [90, 'XC'], [50, 'L'], [40, 'XL'],
        [10, 'X'], [9, 'IX'], [5, 'V'], [4, 'IV'], [1, 'I'],
    ];
    let n = num;
    let result = '';
    for (const [value, numeral] of table) {
        while (n >= value) {
            result += numeral;
            n -= value;
        }
    }
    return result;
}
</script>

<template>
    <div class="bg-white p-10 font-serif text-gray-900">
        <header class="flex items-start gap-4 border-b border-gray-400 pb-3">
            <img
                v-if="resume.personal.photo"
                :src="resume.personal.photo"
                alt="Profile photo"
                class="size-14 shrink-0 rounded-full object-cover"
            />
            <div>
                <h1 class="text-xl font-bold tracking-tight">{{ resume.personal.fullName || 'Your Name' }}</h1>
                <p v-if="resume.personal.title" class="mt-0.5 text-sm italic text-gray-600">
                    {{ resume.personal.title }}
                </p>
                <p v-if="contactLine.length" class="mt-1.5 text-xs leading-snug text-gray-600">
                    {{ contactLine.join(' · ') }}
                </p>
            </div>
        </header>

        <section v-if="resume.summary" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">I. Summary</h2>
            <p class="mt-1 text-sm leading-snug text-gray-700">{{ resume.summary }}</p>
        </section>

        <section v-if="hasExperience" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">II. Experience</h2>
            <div class="mt-1.5 space-y-2">
                <div v-for="entry in resume.experience" :key="entry.id">
                    <div v-if="entry.position || entry.company" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">
                            {{ entry.position }}<span v-if="entry.position && entry.company"> · </span>{{ entry.company }}
                        </p>
                        <p class="shrink-0 text-xs text-gray-500">{{ dateRange(entry.startDate, entry.endDate, entry.current) }}</p>
                    </div>
                    <p v-if="entry.location" class="text-xs text-gray-500">{{ entry.location }}</p>
                    <p v-if="entry.responsibilities" class="mt-0.5 whitespace-pre-line text-sm leading-snug text-gray-700">
                        {{ entry.responsibilities }}
                    </p>
                    <p v-if="entry.achievements" class="mt-0.5 whitespace-pre-line text-sm leading-snug text-gray-700">
                        <span class="font-semibold text-gray-600">Achievements: </span>{{ entry.achievements }}
                    </p>
                </div>
            </div>
        </section>

        <section v-if="hasEducation" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">III. Education</h2>
            <div class="mt-1.5 space-y-1.5">
                <div v-for="entry in resume.education" :key="entry.id">
                    <div v-if="entry.school || entry.degree" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">{{ entry.school }}</p>
                        <p class="shrink-0 text-xs text-gray-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.degree || entry.fieldOfStudy" class="text-xs text-gray-500">
                        {{ entry.degree }}<span v-if="entry.degree && entry.fieldOfStudy">, </span>{{ entry.fieldOfStudy }}
                    </p>
                    <p v-if="entry.description" class="mt-0.5 text-sm leading-snug text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="resume.skills.length" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">IV. Skills</h2>
            <p class="mt-1 text-sm leading-snug text-gray-700">{{ resume.skills.join(', ') }}</p>
        </section>

        <section v-if="hasProjects" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">V. Projects</h2>
            <div class="mt-1.5 space-y-1.5">
                <div v-for="entry in resume.projects" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">
                            {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                        </p>
                        <p class="shrink-0 text-xs text-gray-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-snug text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasCertifications" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">VI. Certifications</h2>
            <div class="mt-1.5 space-y-0.5">
                <div v-for="entry in resume.certifications" :key="entry.id" class="flex items-baseline justify-between gap-2">
                    <p class="text-sm text-gray-700">
                        {{ entry.name }}<span v-if="entry.organization"> — {{ entry.organization }}</span>
                    </p>
                    <p v-if="entry.date" class="shrink-0 text-xs text-gray-500">{{ formatMonth(entry.date) }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasTrainings" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">VII. Trainings & Seminars</h2>
            <div class="mt-1.5 space-y-1.5">
                <div v-for="entry in resume.trainings" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">
                            {{ entry.name }}<span v-if="entry.organizer"> · {{ entry.organizer }}</span>
                        </p>
                        <p v-if="entry.date" class="shrink-0 text-xs text-gray-500">{{ formatMonth(entry.date) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-snug text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasAwards" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">VIII. Awards & Achievements</h2>
            <div class="mt-1.5 space-y-1.5">
                <div v-for="entry in resume.awards" :key="entry.id">
                    <div v-if="entry.name" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">
                            {{ entry.name }}<span v-if="entry.organization"> · {{ entry.organization }}</span>
                        </p>
                        <p v-if="entry.date" class="shrink-0 text-xs text-gray-500">{{ formatMonth(entry.date) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-snug text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasVolunteer" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">IX. Volunteer Experience</h2>
            <div class="mt-1.5 space-y-1.5">
                <div v-for="entry in resume.volunteer" :key="entry.id">
                    <div v-if="entry.organization || entry.role" class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">
                            {{ entry.role }}<span v-if="entry.role && entry.organization"> · </span>{{ entry.organization }}
                        </p>
                        <p class="shrink-0 text-xs text-gray-500">{{ dateRange(entry.startDate, entry.endDate) }}</p>
                    </div>
                    <p v-if="entry.description" class="text-sm leading-snug text-gray-700">{{ entry.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasLanguages" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">X. Languages</h2>
            <p class="mt-1 text-sm leading-snug text-gray-700">
                {{ resume.languages.filter((entry) => entry.language).map((entry) => (entry.proficiency ? `${entry.language} (${entry.proficiency})` : entry.language)).join(' · ') }}
            </p>
        </section>

        <section v-for="(section, idx) in visibleCustomSections" :key="section.id" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">
                {{ toRoman(11 + idx) }}. {{ section.title || 'Additional Information' }}
            </h2>
            <div class="mt-1.5 space-y-1.5">
                <div v-for="item in section.items.filter((entry) => entry.title)" :key="item.id">
                    <div class="flex items-baseline justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-900">
                            {{ item.title }}<span v-if="item.subtitle"> · {{ item.subtitle }}</span>
                        </p>
                        <p v-if="item.date" class="shrink-0 text-xs text-gray-500">{{ item.date }}</p>
                    </div>
                    <p v-if="item.description" class="text-sm leading-snug text-gray-700">{{ item.description }}</p>
                </div>
            </div>
        </section>

        <section v-if="hasReferences" class="mt-3">
            <h2 class="border-b border-gray-300 pb-0.5 text-xs font-bold uppercase tracking-widest text-black">
                {{ toRoman(11 + visibleCustomSections.length) }}. References
            </h2>
            <div class="mt-1.5 space-y-0.5">
                <p v-for="entry in resume.references" :key="entry.id" class="text-sm text-gray-700">
                    {{ entry.name }}<span v-if="entry.position || entry.company">, {{ [entry.position, entry.company].filter(Boolean).join(', ') }}</span
                    ><span v-if="entry.contactNumber || entry.email"> — {{ [entry.contactNumber, entry.email].filter(Boolean).join(' · ') }}</span>
                </p>
            </div>
        </section>
    </div>
</template>
