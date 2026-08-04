/**
 * A filled-out example resume used purely for visual previews (landing page
 * template showcase). Shape must match Composables/useResumeBuilder.js.
 */
export const sampleResume = {
    personal: {
        fullName: 'Maria Santos',
        title: 'Marketing Specialist',
        email: 'maria.santos@email.com',
        phone: '+63 917 123 4567',
        address: 'Davao City, Philippines',
        website: 'mariasantos.com',
        profileLink: 'linkedin.com/in/mariasantos',
        photo: '',
    },
    summary:
        'Results-driven marketing specialist with 4+ years of experience growing brand awareness and driving digital campaigns across social and search channels.',
    experience: [
        {
            id: 'sample-exp-1',
            position: 'Marketing Specialist',
            company: 'Brightleaf Co.',
            location: 'Davao City',
            startDate: '2022-03',
            endDate: '',
            current: true,
            responsibilities: 'Plan and execute multi-channel campaigns across email, social, and search.',
            achievements: 'Grew organic traffic 65% year-over-year and cut cost-per-lead by 30%.',
        },
        {
            id: 'sample-exp-2',
            position: 'Marketing Coordinator',
            company: 'Northwind Retail',
            location: 'Cebu City',
            startDate: '2020-01',
            endDate: '2022-02',
            current: false,
            responsibilities: 'Coordinated seasonal campaigns and managed the content calendar.',
            achievements: '',
        },
    ],
    education: [
        {
            id: 'sample-edu-1',
            school: 'University of Southeastern Philippines',
            degree: 'BS',
            fieldOfStudy: 'Marketing Management',
            startDate: '2015-06',
            endDate: '2019-04',
            description: '',
        },
    ],
    skills: ['Social Media Strategy', 'SEO', 'Google Analytics', 'Content Marketing', 'Email Campaigns'],
    projects: [],
    certifications: [
        { id: 'sample-cert-1', name: 'Google Analytics Certified', organization: 'Google', date: '2023-05' },
    ],
    trainings: [],
    awards: [],
    volunteer: [],
    languages: [
        { id: 'sample-lang-1', language: 'English', proficiency: 'Fluent' },
        { id: 'sample-lang-2', language: 'Filipino', proficiency: 'Native' },
    ],
    references: [],
    customSections: [],
};
