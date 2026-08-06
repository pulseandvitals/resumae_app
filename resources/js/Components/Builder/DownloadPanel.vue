<script setup>
import { ref } from "vue";
import TemplateRenderer from "@/Components/Templates/TemplateRenderer.vue";

const props = defineProps({
    resume: { type: Object, required: true },
    template: { type: Object, default: null },
    paymentStatus: { type: String, default: null }, // null | 'success' | 'failed'
    paymentToken: { type: String, default: null },
});

// Templates render at a natural width of 680px; scale down to fit the small
// max-w-sm preview box so proportions match a real printed page.
const PREVIEW_BOX_WIDTH = 384;
const TEMPLATE_WIDTH = 680;
const SCALE = PREVIEW_BOX_WIDTH / TEMPLATE_WIDTH;

const paymentMethods = [
    {
        key: "gcash",
        label: "GCash",
        hint: "E-wallet",
        accent: "bg-blue-50 text-blue-600",
        icon: "wallet",
    },
    {
        key: "maya",
        label: "Maya",
        hint: "E-wallet",
        accent: "bg-teal-50 text-teal-600",
        icon: "wallet",
    },
    {
        key: "grab_pay",
        label: "GrabPay",
        hint: "E-wallet",
        accent: "bg-emerald-50 text-emerald-600",
        icon: "wallet",
    },
    {
        key: "card",
        label: "Card",
        hint: "Visa, Mastercard, JCB",
        accent: "bg-indigo-50 text-indigo-600",
        icon: "card",
    },
    {
        key: "qrph",
        label: "QR Ph",
        hint: "Scan to pay",
        accent: "bg-purple-50 text-purple-600",
        icon: "qr",
    },
];

const selectedMethod = ref(null);
const isSubmitting = ref(false);
const errorMessage = ref("");

async function pay() {
    if (!selectedMethod.value || !props.template || isSubmitting.value) return;

    isSubmitting.value = true;
    errorMessage.value = "";

    try {
        const { data } = await window.axios.post("/checkout", {
            resume_template_id: props.template.id,
            method: selectedMethod.value,
            customer_name: props.resume.personal.fullName || null,
            customer_email: props.resume.personal.email || null,
        });

        if (!data?.checkout_url) {
            throw new Error("No checkout URL was returned.");
        }

        window.location.href = data.checkout_url;
    } catch (error) {
        errorMessage.value =
            error.response?.data?.message ||
            "Something went wrong starting checkout. Please try again.";
        isSubmitting.value = false;
    }
}

// A full-size, off-screen copy of the template used only to capture real
// rendered markup for the PDF — the visible preview is scaled/blurred and
// isn't a faithful source to print from.
const printableTemplate = ref(null);
const isDownloadingPdf = ref(false);
const pdfError = ref("");
// The download link is one-time use — the server erases the token as soon
// as a PDF is generated, so this flips permanently once that happens.
const hasDownloaded = ref(false);

async function downloadPdf() {
    if (
        !props.paymentToken ||
        !printableTemplate.value ||
        isDownloadingPdf.value ||
        hasDownloaded.value
    )
        return;

    isDownloadingPdf.value = true;
    pdfError.value = "";

    try {
        // TemplateRenderer's own root div (mx-auto/max-w/shadow/ring) is
        // only meant for the on-screen card look — capture its child, the
        // actual template's root, so the PDF fills the page edge to edge.
        const html = printableTemplate.value.$el.firstElementChild.outerHTML;

        const response = await window.axios.post(
            `/payments/${props.paymentToken}/pdf`,
            { html },
            { responseType: "blob" },
        );

        const blobUrl = URL.createObjectURL(response.data);
        const link = document.createElement("a");
        link.href = blobUrl;
        link.download = `${(props.template?.name || "resume").toLowerCase()}-resume.pdf`;
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(blobUrl);

        hasDownloaded.value = true;
    } catch (error) {
        if (error.response?.status === 404) {
            // The token was already used (e.g. a duplicate click that
            // landed after an earlier request already succeeded).
            hasDownloaded.value = true;
        } else if (error.response?.data instanceof Blob) {
            try {
                const text = await error.response.data.text();
                pdfError.value =
                    JSON.parse(text).message ??
                    "Something went wrong generating your PDF.";
            } catch {
                pdfError.value =
                    "Something went wrong generating your PDF. Please try again.";
            }
        } else {
            pdfError.value =
                "Something went wrong generating your PDF. Please try again.";
        }
    } finally {
        isDownloadingPdf.value = false;
    }
}
</script>

<template>
    <div class="grid gap-8 lg:grid-cols-2 lg:items-start">
        <div
            v-if="template"
            class="pointer-events-none absolute -left-[9999px] top-0 -z-10"
            aria-hidden="true"
        >
            <TemplateRenderer
                ref="printableTemplate"
                :template-key="template.key"
                :resume="resume"
            />
        </div>

        <div class="mx-auto w-full max-w-sm">
            <div
                class="relative max-h-[560px] overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-gray-900/10"
            >
                <div
                    v-if="template"
                    class="select-none"
                    :class="
                        paymentStatus === 'success'
                            ? ''
                            : 'pointer-events-none blur-sm'
                    "
                    :style="{ zoom: SCALE }"
                >
                    <TemplateRenderer
                        :template-key="template.key"
                        :resume="resume"
                    />
                </div>
                <div
                    v-if="paymentStatus !== 'success'"
                    class="absolute inset-0 bg-gradient-to-b from-white/10 via-white/30 to-white/60"
                ></div>
                <div
                    v-if="paymentStatus !== 'success'"
                    class="absolute inset-0 flex items-center justify-center"
                >
                    <span
                        class="flex items-center gap-1.5 rounded-full bg-gray-900/85 px-4 py-2 text-xs font-bold uppercase tracking-wide text-white shadow-lg backdrop-blur-sm"
                    >
                        <svg
                            class="size-3.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                            />
                        </svg>
                        Preview Only
                    </span>
                </div>
                <span
                    v-if="paymentStatus === 'success'"
                    class="absolute right-3 top-3 flex items-center gap-1.5 rounded-full bg-emerald-600 px-3 py-1.5 text-xs font-bold uppercase tracking-wide text-white shadow-lg"
                >
                    <svg
                        class="size-3.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.5 12.75l6 6 9-13.5"
                        />
                    </svg>
                    Paid
                </span>
            </div>
            <p
                v-if="paymentStatus === 'success'"
                class="mt-3 text-center text-xs font-medium text-emerald-600"
            >
                Payment received — your full-resolution PDF is ready on the
                right.
            </p>
            <p v-else class="mt-3 text-center text-xs text-gray-400">
                The full-resolution PDF unlocks after payment.
            </p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-900/5">
            <h2 class="text-lg font-semibold text-gray-900">
                Download your resume
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Unlimited edits were free. Pay once to download the finished,
                high-quality PDF.
            </p>

            <div
                class="mt-5 flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3"
            >
                <div>
                    <p class="text-sm font-medium text-gray-900">
                        {{ template?.name ?? "Selected template" }}
                    </p>
                    <p class="text-xs text-gray-500">
                        One-time payment · print-ready PDF
                    </p>
                </div>
                <p class="text-2xl font-bold text-gray-900">
                    &#8369;{{
                        template ? Number(template.price).toFixed(0) : "—"
                    }}
                </p>
            </div>

            <div
                v-if="paymentStatus === 'success'"
                class="mt-5 rounded-lg bg-emerald-50 p-4 text-center"
            >
                <p class="text-sm font-semibold text-emerald-700">
                    Payment successful — thank you!
                </p>

                <template v-if="hasDownloaded">
                    <p class="mt-3 flex items-center justify-center gap-1.5 text-sm font-semibold text-emerald-700">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        Downloaded
                    </p>
                    <p class="mt-1 text-xs text-emerald-600">
                        Your PDF has been downloaded. This link can only be used once, so save the file somewhere safe.
                    </p>
                </template>

                <template v-else>
                    <p class="mt-1 text-xs text-emerald-600">
                        Your PDF is ready to download.
                    </p>

                    <button
                        type="button"
                        class="mt-4 flex w-full items-center justify-center gap-2 rounded-md bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:text-gray-400"
                        :disabled="isDownloadingPdf"
                        @click="downloadPdf"
                    >
                        <svg
                            v-if="!isDownloadingPdf"
                            class="size-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 12l4.5 4.5m0 0l4.5-4.5M12 16.5V3"
                            />
                        </svg>
                        <svg
                            v-else
                            class="size-4 animate-spin"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" d="M12 3a9 9 0 1 0 9 9" />
                        </svg>
                        {{
                            isDownloadingPdf
                                ? "Generating your PDF…"
                                : "Download PDF"
                        }}
                    </button>
                </template>

                <p
                    v-if="pdfError"
                    class="mt-3 text-xs font-medium text-red-600"
                >
                    {{ pdfError }}
                </p>
            </div>

            <div v-else class="mt-5">
                <p
                    v-if="paymentStatus === 'failed'"
                    class="mb-3 rounded-lg bg-red-50 px-3 py-2 text-center text-xs font-medium text-red-600"
                >
                    Your payment didn't go through. No charge was made — please
                    try again.
                </p>

                <div class="flex items-center justify-between gap-2">
                    <p class="text-sm font-medium text-gray-700">
                        Choose a payment method
                    </p>
                    <span
                        class="flex items-center gap-1 text-[11px] font-medium text-emerald-600"
                    >
                        <svg
                            class="size-3.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75l1.5 1.5L15 9.75M12 3l7.5 4.5v9L12 21l-7.5-4.5v-9L12 3z"
                            />
                        </svg>
                        No hidden charges
                    </span>
                </div>
                <p class="mt-1 text-xs text-gray-400">
                    Easy, fast checkout — pay
                    {{
                        template
                            ? `₱${Number(template.price).toFixed(0)}`
                            : "the listed price"
                    }}
                    once, that's it. No subscriptions, no surprise fees.
                </p>
                <div class="mt-2 grid grid-cols-2 gap-2">
                    <label
                        v-for="method in paymentMethods"
                        :key="method.key"
                        class="flex cursor-pointer items-center gap-2.5 rounded-lg border-2 p-3 transition"
                        :class="
                            selectedMethod === method.key
                                ? 'border-indigo-500 bg-indigo-50/50'
                                : 'border-gray-200 hover:border-gray-300'
                        "
                    >
                        <input
                            type="radio"
                            name="payment-method"
                            :value="method.key"
                            v-model="selectedMethod"
                            class="sr-only"
                            @change="errorMessage = ''"
                        />
                        <span
                            class="flex size-8 shrink-0 items-center justify-center rounded-full"
                            :class="method.accent"
                        >
                            <svg
                                v-if="method.icon === 'wallet'"
                                class="size-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a1.5 1.5 0 0 0 0 3h3.75A2.25 2.25 0 0 0 21 12Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7.5A2.25 2.25 0 0 1 5.25 5.25h10.5A2.25 2.25 0 0 1 18 7.5v9a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 16.5v-9Z"
                                />
                            </svg>
                            <svg
                                v-else-if="method.icon === 'card'"
                                class="size-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 6.75h19.5A1.5 1.5 0 0 1 23.25 8.25v9a1.5 1.5 0 0 1-1.5 1.5H2.25a1.5 1.5 0 0 1-1.5-1.5v-9a1.5 1.5 0 0 1 1.5-1.5ZM5.25 15h3"
                                />
                            </svg>
                            <svg
                                v-else
                                class="size-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.75"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 3.75h4.5v4.5h-4.5v-4.5ZM15.75 3.75h4.5v4.5h-4.5v-4.5ZM3.75 15.75h4.5v4.5h-4.5v-4.5Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 6h0M18 6h0M6 18h0"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.25 14.25h2.25v2.25h-2.25v-2.25ZM14.25 19.5h1.5M19.5 14.25v1.5M19.5 19.5h.008v.008H19.5V19.5Z"
                                />
                            </svg>
                        </span>
                        <span>
                            <span
                                class="block text-sm font-semibold text-gray-900"
                                >{{ method.label }}</span
                            >
                            <span class="block text-[11px] text-gray-500">{{
                                method.hint
                            }}</span>
                        </span>
                    </label>
                </div>

                <button
                    type="button"
                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-md bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 disabled:cursor-not-allowed disabled:bg-gray-200 disabled:text-gray-400"
                    :disabled="!selectedMethod || isSubmitting"
                    @click="pay"
                >
                    <svg
                        v-if="!isSubmitting"
                        class="size-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                        />
                    </svg>
                    <svg
                        v-else
                        class="size-4 animate-spin"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" d="M12 3a9 9 0 1 0 9 9" />
                    </svg>
                    {{
                        isSubmitting
                            ? "Redirecting to checkout…"
                            : `Pay ${template ? `₱${Number(template.price).toFixed(0)}` : ""}`
                    }}
                </button>

                <p
                    v-if="errorMessage"
                    class="mt-3 text-center text-xs font-medium text-red-600"
                >
                    {{ errorMessage }}
                </p>
                <p
                    v-else
                    class="mt-3 flex items-center justify-center gap-1.5 text-xs text-gray-400"
                >
                    <svg
                        class="size-3.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                        />
                    </svg>
                    Payments secured by PayMongo
                </p>
            </div>
        </div>
    </div>
</template>
