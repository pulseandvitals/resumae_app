import { reactive, watch } from 'vue';

const STORAGE_KEY = 'resumae:resume-data';

function emptyExperience() {
    return {
        id: crypto.randomUUID(),
        position: '',
        company: '',
        location: '',
        startDate: '',
        endDate: '',
        current: false,
        responsibilities: '',
        achievements: '',
    };
}

function emptyEducation() {
    return {
        id: crypto.randomUUID(),
        school: '',
        degree: '',
        fieldOfStudy: '',
        startDate: '',
        endDate: '',
        description: '',
    };
}

function emptyProject() {
    return {
        id: crypto.randomUUID(),
        name: '',
        organization: '',
        description: '',
        startDate: '',
        endDate: '',
    };
}

function emptyCertification() {
    return {
        id: crypto.randomUUID(),
        name: '',
        organization: '',
        date: '',
    };
}

function emptyTraining() {
    return {
        id: crypto.randomUUID(),
        name: '',
        organizer: '',
        date: '',
        description: '',
    };
}

function emptyAward() {
    return {
        id: crypto.randomUUID(),
        name: '',
        organization: '',
        date: '',
        description: '',
    };
}

function emptyVolunteer() {
    return {
        id: crypto.randomUUID(),
        organization: '',
        role: '',
        startDate: '',
        endDate: '',
        description: '',
    };
}

function emptyLanguage() {
    return {
        id: crypto.randomUUID(),
        language: '',
        proficiency: '',
    };
}

function emptyReference() {
    return {
        id: crypto.randomUUID(),
        name: '',
        position: '',
        company: '',
        contactNumber: '',
        email: '',
    };
}

function emptyCustomItem() {
    return {
        id: crypto.randomUUID(),
        title: '',
        subtitle: '',
        date: '',
        description: '',
    };
}

function emptyCustomSection() {
    return {
        id: crypto.randomUUID(),
        title: '',
        items: [emptyCustomItem()],
    };
}

function defaultResume() {
    return {
        personal: {
            fullName: '',
            title: '',
            email: '',
            phone: '',
            address: '',
            website: '',
            profileLink: '',
            photo: '',
        },
        summary: '',
        experience: [emptyExperience()],
        education: [emptyEducation()],
        skills: [],
        projects: [],
        certifications: [],
        trainings: [],
        awards: [],
        volunteer: [],
        languages: [],
        references: [],
        customSections: [],
    };
}

function loadResume() {
    if (typeof window === 'undefined') return defaultResume();

    try {
        const stored = window.localStorage.getItem(STORAGE_KEY);
        if (!stored) return defaultResume();

        const parsed = JSON.parse(stored);
        return { ...defaultResume(), ...parsed };
    } catch {
        return defaultResume();
    }
}

const resume = reactive(loadResume());

if (typeof window !== 'undefined') {
    watch(
        resume,
        (value) => {
            window.localStorage.setItem(STORAGE_KEY, JSON.stringify(value));
        },
        { deep: true },
    );
}

export function useResumeBuilder() {
    function addExperience() {
        resume.experience.push(emptyExperience());
    }

    function removeExperience(id) {
        resume.experience = resume.experience.filter((entry) => entry.id !== id);
    }

    function addEducation() {
        resume.education.push(emptyEducation());
    }

    function removeEducation(id) {
        resume.education = resume.education.filter((entry) => entry.id !== id);
    }

    function addSkill(skill) {
        const trimmed = skill.trim();
        if (trimmed && !resume.skills.includes(trimmed)) {
            resume.skills.push(trimmed);
        }
    }

    function removeSkill(skill) {
        resume.skills = resume.skills.filter((entry) => entry !== skill);
    }

    function addProject() {
        resume.projects.push(emptyProject());
    }

    function removeProject(id) {
        resume.projects = resume.projects.filter((entry) => entry.id !== id);
    }

    function addCertification() {
        resume.certifications.push(emptyCertification());
    }

    function removeCertification(id) {
        resume.certifications = resume.certifications.filter((entry) => entry.id !== id);
    }

    function addTraining() {
        resume.trainings.push(emptyTraining());
    }

    function removeTraining(id) {
        resume.trainings = resume.trainings.filter((entry) => entry.id !== id);
    }

    function addAward() {
        resume.awards.push(emptyAward());
    }

    function removeAward(id) {
        resume.awards = resume.awards.filter((entry) => entry.id !== id);
    }

    function addVolunteer() {
        resume.volunteer.push(emptyVolunteer());
    }

    function removeVolunteer(id) {
        resume.volunteer = resume.volunteer.filter((entry) => entry.id !== id);
    }

    function addLanguage() {
        resume.languages.push(emptyLanguage());
    }

    function removeLanguage(id) {
        resume.languages = resume.languages.filter((entry) => entry.id !== id);
    }

    function addReference() {
        resume.references.push(emptyReference());
    }

    function removeReference(id) {
        resume.references = resume.references.filter((entry) => entry.id !== id);
    }

    function addCustomSection() {
        resume.customSections.push(emptyCustomSection());
    }

    function removeCustomSection(id) {
        resume.customSections = resume.customSections.filter((section) => section.id !== id);
    }

    function addCustomItem(sectionId) {
        const section = resume.customSections.find((entry) => entry.id === sectionId);
        section?.items.push(emptyCustomItem());
    }

    function removeCustomItem(sectionId, itemId) {
        const section = resume.customSections.find((entry) => entry.id === sectionId);
        if (!section) return;
        section.items = section.items.filter((item) => item.id !== itemId);
    }

    function resetResume() {
        Object.assign(resume, defaultResume());
    }

    return {
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
        resetResume,
    };
}
