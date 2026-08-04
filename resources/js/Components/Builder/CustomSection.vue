<script setup>
import BuilderSection from '@/Components/Builder/BuilderSection.vue';
import BuilderField from '@/Components/Builder/BuilderField.vue';
import BuilderTextarea from '@/Components/Builder/BuilderTextarea.vue';
import AddButton from '@/Components/Builder/AddButton.vue';

defineProps({
    customSections: { type: Array, required: true },
});

defineEmits(['addSection', 'removeSection', 'addItem', 'removeItem']);
</script>

<template>
    <BuilderSection
        title="Custom Sections"
        optional
        description="Add your own section, e.g. Publications, Licenses, Hobbies, Memberships."
    >
        <div class="space-y-6">
            <div
                v-for="section in customSections"
                :key="section.id"
                class="rounded-lg border border-gray-200 p-5"
            >
                <div class="flex items-start gap-3">
                    <BuilderField
                        v-model="section.title"
                        label="Section Title"
                        placeholder="e.g. Publications"
                        class="flex-1"
                    />
                    <button
                        type="button"
                        class="mt-6 flex items-center gap-1 text-sm font-medium text-red-500 transition hover:text-red-600"
                        @click="$emit('removeSection', section.id)"
                    >
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Remove Section
                    </button>
                </div>

                <div class="mt-4 space-y-3">
                    <div
                        v-for="item in section.items"
                        :key="item.id"
                        class="rounded-md bg-gray-50 p-4"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-medium text-gray-500">Item</span>
                            <button
                                type="button"
                                class="text-xs font-medium text-red-500 transition hover:text-red-600"
                                @click="$emit('removeItem', section.id, item.id)"
                            >
                                Remove
                            </button>
                        </div>
                        <div class="mt-2 grid gap-3 sm:grid-cols-2">
                            <BuilderField v-model="item.title" label="Item Title" />
                            <BuilderField v-model="item.subtitle" label="Subtitle" placeholder="Optional" />
                            <BuilderField v-model="item.date" label="Date" placeholder="Optional" />
                            <BuilderTextarea v-model="item.description" label="Description" :rows="2" span />
                        </div>
                    </div>

                    <AddButton label="Add Item" @click="$emit('addItem', section.id)" />
                </div>
            </div>

            <AddButton label="Add Custom Section" @click="$emit('addSection')" />
        </div>
    </BuilderSection>
</template>
