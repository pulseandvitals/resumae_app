<script setup>
import { computed, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import TemplateRenderer from '@/Components/Templates/TemplateRenderer.vue';
import TemplatePreviewCard from '@/Components/Landing/TemplatePreviewCard.vue';
import { sampleResume } from '@/sampleResume';

const props = defineProps({
    templates: { type: Array, default: () => [] },
});

const features = [
    {
        title: 'No Login Required',
        description: 'Start building right away. No account, no email, no friction.',
    },
    {
        title: 'Free Resume Builder',
        description: 'Fill out every section of your resume at no cost, with unlimited edits.',
    },
    {
        title: 'Live Preview',
        description: 'Watch your resume update instantly as you type, section by section.',
    },
    {
        title: '10 Designer Templates',
        description: 'Modern, Classic, Executive, Creative and more — switch freely before you pay.',
    },
    {
        title: 'Instant PDF Download',
        description: 'Pay once, download instantly — your PDF is generated right after payment.',
    },
    {
        title: 'Mobile Friendly',
        description: 'Build and preview your resume comfortably from any device.',
    },
];

const faqs = [
    {
        question: 'Do I need to create an account?',
        answer: "No. You can build, edit, and preview your resume without signing up. We only ask for payment when you're ready to download the PDF.",
    },
    {
        question: 'Is ResumAE really free?',
        answer: "Yes — filling out your resume, switching templates, and previewing it live are all free with unlimited edits. You only pay a small one-time fee when you download the finished PDF.",
    },
    {
        question: 'What payment methods are supported?',
        answer: 'GCash, Maya, PayMongo, Stripe, PayPal, and credit/debit cards.',
    },
    {
        question: 'Can I switch templates after I start filling in my details?',
        answer: 'Yes. Your information stays the same — switch between any of the 10 templates as many times as you like before downloading.',
    },
    {
        question: 'Will my resume work with ATS (applicant tracking systems)?',
        answer: 'Every template uses clean, single-column-friendly layouts and standard section headings, which are easy for ATS software to parse correctly.',
    },
    {
        question: 'Is my information stored anywhere?',
        answer: "Your resume data stays in your browser while you edit — it isn't saved on our servers until you choose to download.",
    },
];
const openFaq = ref(0);

const startingPrice = computed(() => {
    if (!props.templates.length) return null;
    return Math.min(...props.templates.map((template) => Number(template.price)));
});

const jsonLd = computed(() => ({
    '@context': 'https://schema.org',
    '@type': 'WebApplication',
    name: 'ResumAE',
    applicationCategory: 'BusinessApplication',
    operatingSystem: 'Any',
    description:
        'Build a professional resume online for free. No sign-up required — live preview, designer templates, and instant PDF download after a one-time payment.',
    offers: {
        '@type': 'Offer',
        price: startingPrice.value ?? '39',
        priceCurrency: 'PHP',
    },
}));
</script>

<template>
    <Head title="Free Resume Maker Online, No Sign-Up Required">
        <component :is="'script'" type="application/ld+json">{{ JSON.stringify(jsonLd) }}</component>
    </Head>

    <div class="min-h-screen bg-gray-50 text-gray-900">
        <!-- Nav -->
        <header class="border-b border-gray-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <span class="text-lg font-bold tracking-tight text-gray-900">
                    Resum<span class="text-indigo-600">AE</span>
                </span>
                <nav class="hidden items-center gap-8 sm:flex">
                    <a href="#templates" class="text-sm font-medium text-gray-600 hover:text-gray-900">Templates</a>
                    <a href="#faq" class="text-sm font-medium text-gray-600 hover:text-gray-900">FAQ</a>
                </nav>
                <Link
                    :href="route('builder')"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                >
                    Start Building for Free
                </Link>
            </div>
        </header>

        <!-- Hero -->
        <section class="mx-auto max-w-7xl px-6 pb-20 pt-16 sm:pt-24">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">
                        Free Resume Builder — No Sign-Up
                    </span>
                    <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                        Write a resume that gets you
                        <span class="text-indigo-600">hired</span> — free
                    </h1>
                    <p class="mt-6 text-lg leading-relaxed text-gray-600">
                        Fill in your details, pick from 10 designer templates, and preview your
                        resume live. No account, no spam — pay only when you're ready to download
                        the PDF.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <Link
                            :href="route('builder')"
                            class="rounded-md bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                        >
                            Start Building for Free
                        </Link>
                        <a
                            href="#templates"
                            class="text-base font-semibold text-gray-700 transition hover:text-gray-900"
                        >
                            Browse templates &rarr;
                        </a>
                    </div>
                    <dl class="mt-10 grid grid-cols-3 gap-6 border-t border-gray-200 pt-6">
                        <div>
                            <dt class="text-2xl font-bold text-gray-900">10</dt>
                            <dd class="text-sm text-gray-500">Templates</dd>
                        </div>
                        <div>
                            <dt class="text-2xl font-bold text-gray-900">₱0</dt>
                            <dd class="text-sm text-gray-500">To build & preview</dd>
                        </div>
                        <div>
                            <dt class="text-2xl font-bold text-gray-900">0</dt>
                            <dd class="text-sm text-gray-500">Accounts needed</dd>
                        </div>
                    </dl>
                </div>

                <!-- Real template previews, fanned for depth -->
                <div class="relative mx-auto h-[420px] w-full max-w-sm sm:h-[460px]">
                    <div
                        class="absolute left-1/2 top-2 w-[78%] -translate-x-1/2 -rotate-6 overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-gray-900/5"
                    >
                        <div class="h-64 overflow-hidden">
                            <div class="origin-top-left" style="transform: scale(0.34); width: 294%">
                                <TemplateRenderer template-key="executive" :resume="sampleResume" />
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute right-1/2 top-2 w-[78%] translate-x-1/2 rotate-6 overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-gray-900/5"
                    >
                        <div class="h-64 overflow-hidden">
                            <div class="origin-top-left" style="transform: scale(0.34); width: 294%">
                                <TemplateRenderer template-key="creative" :resume="sampleResume" />
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute inset-x-0 bottom-0 mx-auto w-[85%] overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-gray-900/5"
                    >
                        <div class="h-80 overflow-hidden">
                            <div class="origin-top-left" style="transform: scale(0.37); width: 270%">
                                <TemplateRenderer template-key="modern" :resume="sampleResume" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="features" class="border-t border-gray-200 bg-white py-20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Everything you need to get hired
                    </h2>
                    <p class="mt-4 text-gray-600">
                        A fast, no-friction way to go from blank page to polished, downloadable
                        resume.
                    </p>
                </div>

                <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="feature in features"
                        :key="feature.title"
                        class="rounded-lg border border-gray-200 p-6 transition hover:border-indigo-200 hover:shadow-sm"
                    >
                        <div
                            class="flex size-10 items-center justify-center rounded-full bg-indigo-50 text-indigo-600"
                        >
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l1.5 1.5L15 9.75M12 3l7.5 4.5v9L12 21l-7.5-4.5v-9L12 3z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-gray-900">
                            {{ feature.title }}
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">
                            {{ feature.description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Templates showcase -->
        <section id="templates" class="border-t border-gray-200 bg-gray-50 py-20">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Pick a template you actually like
                    </h2>
                    <p class="mt-4 text-gray-600">
                        Every template is a real, working design — click one to start building
                        with it selected.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <TemplatePreviewCard v-for="template in templates" :key="template.key" :template="template" />
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="border-t border-gray-200 bg-white py-20">
            <div class="mx-auto max-w-3xl px-6">
                <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">
                    Frequently asked questions
                </h2>

                <dl class="mt-10 divide-y divide-gray-200 border-t border-gray-200">
                    <div v-for="(faq, index) in faqs" :key="faq.question" class="py-4">
                        <dt>
                            <button
                                type="button"
                                class="flex w-full items-center justify-between gap-4 text-left text-sm font-semibold text-gray-900"
                                @click="openFaq = openFaq === index ? -1 : index"
                            >
                                {{ faq.question }}
                                <svg
                                    class="size-4 shrink-0 text-gray-400 transition-transform"
                                    :class="{ 'rotate-45': openFaq === index }"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </dt>
                        <dd v-show="openFaq === index" class="mt-2 pr-8 text-sm leading-relaxed text-gray-600">
                            {{ faq.answer }}
                        </dd>
                    </div>
                </dl>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-indigo-600">
            <div class="mx-auto max-w-4xl px-6 py-16 text-center">
                <h2 class="text-3xl font-bold tracking-tight text-white">
                    Ready to build your resume?
                </h2>
                <p class="mt-4 text-indigo-100">
                    It's free to build, edit, and preview — pay only when you're ready to
                    download.
                </p>
                <Link
                    :href="route('builder')"
                    class="mt-8 inline-block rounded-md bg-white px-6 py-3 text-base font-semibold text-indigo-600 shadow-sm transition hover:bg-indigo-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600"
                >
                    Start Building for Free
                </Link>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-gray-200 bg-white py-8">
            <div class="mx-auto max-w-7xl px-6 text-center text-sm text-gray-500">
                &copy; {{ new Date().getFullYear() }} ResumAE. No login required, ever.
            </div>
        </footer>
    </div>
</template>
