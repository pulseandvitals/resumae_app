import { computed } from 'vue';

function normalize(value) {
    return value.trim().toLowerCase();
}

function skillMatchesRole(skill, role) {
    const normalizedSkill = normalize(skill);
    const normalizedRole = normalize(role);
    if (!normalizedSkill || !normalizedRole) return false;
    return normalizedRole.includes(normalizedSkill) || normalizedSkill.includes(normalizedRole);
}

/**
 * Returns a computed Set of template keys whose `recommended_roles` match at
 * least one of the user's entered skills. Empty until the user has entered
 * at least one skill.
 */
export function useRecommendedTemplates(templates, skills) {
    return computed(() => {
        const enteredSkills = (skills.value ?? []).filter(Boolean);
        if (!enteredSkills.length) return new Set();

        const matches = new Set();
        for (const template of templates.value ?? []) {
            const roles = template.recommended_roles ?? [];
            if (roles.some((role) => enteredSkills.some((skill) => skillMatchesRole(skill, role)))) {
                matches.add(template.key);
            }
        }
        return matches;
    });
}
