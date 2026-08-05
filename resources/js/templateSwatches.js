/**
 * Lightweight visual hints (accent color + font) for each template key, used
 * by small UI chips (admin list, builder picker) that don't need to render
 * the full template component. Keep keys in sync with Components/Templates/registry.js.
 */
export const TEMPLATE_SWATCHES = {
    modern: { accent: 'bg-indigo-500', font: 'font-sans' },
    classic: { accent: 'bg-gray-800', font: 'font-serif' },
    minimal: { accent: 'bg-gray-300', font: 'font-sans' },
    professional: { accent: 'bg-slate-700', font: 'font-sans' },
    executive: { accent: 'bg-amber-500', font: 'font-serif' },
    creative: { accent: 'bg-violet-500', font: 'font-sans' },
    student: { accent: 'bg-sky-500', font: 'font-sans' },
    compact: { accent: 'bg-gray-500', font: 'font-sans' },
    elegant: { accent: 'bg-rose-400', font: 'font-serif' },
    technical: { accent: 'bg-teal-500', font: 'font-mono' },
    bold: { accent: 'bg-black', font: 'font-sans' },
    corporate: { accent: 'bg-slate-900', font: 'font-sans' },
    timeline: { accent: 'bg-blue-500', font: 'font-sans' },
    infographic: { accent: 'bg-orange-500', font: 'font-sans' },
    monochrome: { accent: 'bg-gray-900', font: 'font-sans' },
    photo: { accent: 'bg-indigo-600', font: 'font-sans' },
    twocolumn: { accent: 'bg-emerald-600', font: 'font-sans' },
    academic: { accent: 'bg-stone-700', font: 'font-serif' },
    startup: { accent: 'bg-purple-500', font: 'font-sans' },
    swiss: { accent: 'bg-red-600', font: 'font-sans' },
};

export function templateSwatch(key) {
    return TEMPLATE_SWATCHES[key] ?? { accent: 'bg-gray-400', font: 'font-sans' };
}
