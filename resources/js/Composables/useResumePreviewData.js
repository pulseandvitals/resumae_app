import { computed } from 'vue';

export function formatMonth(value, fallback = '') {
    if (!value) return fallback;
    const [year, month] = value.split('-');
    if (!year || !month) return value;
    const date = new Date(Number(year), Number(month) - 1, 1);
    return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
}

export function dateRange(start, end, current = false) {
    const startLabel = formatMonth(start);
    const endLabel = current ? 'Present' : formatMonth(end, 'Present');
    if (!startLabel && !endLabel) return '';
    return [startLabel, endLabel].filter(Boolean).join(' — ');
}

/**
 * Shared computed visibility flags + derived values used by every resume
 * template component, so each template only has to handle presentation.
 */
export function useResumePreviewData(resume) {
    const contactLine = computed(() => {
        const { email, phone, address, website, profileLink } = resume.personal;
        return [email, phone, address, website, profileLink].filter(Boolean);
    });

    const hasExperience = computed(() =>
        resume.experience.some((entry) => entry.position || entry.company),
    );
    const hasEducation = computed(() =>
        resume.education.some((entry) => entry.school || entry.degree),
    );
    const hasProjects = computed(() =>
        resume.projects.some((entry) => entry.name || entry.description),
    );
    const hasCertifications = computed(() => resume.certifications.some((entry) => entry.name));
    const hasTrainings = computed(() => resume.trainings.some((entry) => entry.name));
    const hasAwards = computed(() => resume.awards.some((entry) => entry.name));
    const hasVolunteer = computed(() =>
        resume.volunteer.some((entry) => entry.organization || entry.role),
    );
    const hasLanguages = computed(() => resume.languages.some((entry) => entry.language));
    const hasReferences = computed(() => resume.references.some((entry) => entry.name));
    const visibleCustomSections = computed(() =>
        resume.customSections.filter(
            (section) => section.title || section.items.some((item) => item.title),
        ),
    );

    return {
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
    };
}
