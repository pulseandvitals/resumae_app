import ModernTemplate from '@/Components/Templates/ModernTemplate.vue';
import ClassicTemplate from '@/Components/Templates/ClassicTemplate.vue';
import MinimalTemplate from '@/Components/Templates/MinimalTemplate.vue';
import ProfessionalTemplate from '@/Components/Templates/ProfessionalTemplate.vue';
import ExecutiveTemplate from '@/Components/Templates/ExecutiveTemplate.vue';
import CreativeTemplate from '@/Components/Templates/CreativeTemplate.vue';
import StudentTemplate from '@/Components/Templates/StudentTemplate.vue';
import CompactTemplate from '@/Components/Templates/CompactTemplate.vue';
import ElegantTemplate from '@/Components/Templates/ElegantTemplate.vue';
import TechnicalTemplate from '@/Components/Templates/TechnicalTemplate.vue';

/**
 * Maps a ResumeTemplate's `key` (set by the admin) to its Vue component.
 * Keep in sync with App\Models\ResumeTemplate::AVAILABLE_KEYS.
 */
export const TEMPLATE_COMPONENTS = {
    modern: ModernTemplate,
    classic: ClassicTemplate,
    minimal: MinimalTemplate,
    professional: ProfessionalTemplate,
    executive: ExecutiveTemplate,
    creative: CreativeTemplate,
    student: StudentTemplate,
    compact: CompactTemplate,
    elegant: ElegantTemplate,
    technical: TechnicalTemplate,
};
