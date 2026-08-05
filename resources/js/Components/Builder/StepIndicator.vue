<script setup>
const props = defineProps({
    steps: { type: Array, required: true },
    currentStep: { type: Number, required: true },
    maxStepReached: { type: Number, required: true },
});

defineEmits(['go']);

function circleClass(id) {
    if (id === props.currentStep) return 'bg-indigo-600 text-white';
    if (id < props.currentStep) return 'bg-indigo-100 text-indigo-600';
    return 'bg-gray-100 text-gray-400';
}
</script>

<template>
    <ol class="flex items-center justify-center">
        <li v-for="(step, index) in steps" :key="step.id" class="flex items-center">
            <button
                type="button"
                class="flex items-center gap-2 rounded-md px-1.5 py-1 disabled:cursor-not-allowed"
                :disabled="step.id > maxStepReached"
                @click="$emit('go', step.id)"
            >
                <span
                    class="flex size-7 shrink-0 items-center justify-center rounded-full text-xs font-semibold transition"
                    :class="circleClass(step.id)"
                >
                    <svg v-if="step.id < currentStep" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <template v-else>{{ step.id }}</template>
                </span>
                <span
                    class="hidden text-sm font-medium sm:inline"
                    :class="step.id === currentStep ? 'text-gray-900' : 'text-gray-500'"
                >
                    {{ step.label }}
                </span>
            </button>
            <span v-if="index < steps.length - 1" class="mx-1 h-px w-5 shrink-0 bg-gray-300 sm:mx-2 sm:w-10"></span>
        </li>
    </ol>
</template>
