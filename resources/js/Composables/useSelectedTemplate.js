import { ref, watch } from 'vue';

const STORAGE_KEY = 'resumae:selected-template';

function loadSelectedKey(fallback) {
    if (typeof window === 'undefined') return fallback;
    return window.localStorage.getItem(STORAGE_KEY) || fallback;
}

export function useSelectedTemplate(templates) {
    const fallback = templates[0]?.key ?? 'modern';
    const selectedKey = ref(loadSelectedKey(fallback));

    if (!templates.some((template) => template.key === selectedKey.value)) {
        selectedKey.value = fallback;
    }

    if (typeof window !== 'undefined') {
        watch(selectedKey, (value) => {
            window.localStorage.setItem(STORAGE_KEY, value);
        });
    }

    return { selectedKey };
}
