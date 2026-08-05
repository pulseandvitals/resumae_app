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
import BoldTemplate from '@/Components/Templates/BoldTemplate.vue';
import CorporateTemplate from '@/Components/Templates/CorporateTemplate.vue';
import TimelineTemplate from '@/Components/Templates/TimelineTemplate.vue';
import InfographicTemplate from '@/Components/Templates/InfographicTemplate.vue';
import MonochromeTemplate from '@/Components/Templates/MonochromeTemplate.vue';
import PhotoTemplate from '@/Components/Templates/PhotoTemplate.vue';
import TwoColumnTemplate from '@/Components/Templates/TwoColumnTemplate.vue';
import AcademicTemplate from '@/Components/Templates/AcademicTemplate.vue';
import StartupTemplate from '@/Components/Templates/StartupTemplate.vue';
import SwissTemplate from '@/Components/Templates/SwissTemplate.vue';
import SidebarNavyTemplate from '@/Components/Templates/SidebarNavyTemplate.vue';
import SidebarForestTemplate from '@/Components/Templates/SidebarForestTemplate.vue';
import SidebarPlumTemplate from '@/Components/Templates/SidebarPlumTemplate.vue';
import BannerCrimsonTemplate from '@/Components/Templates/BannerCrimsonTemplate.vue';
import BannerTealTemplate from '@/Components/Templates/BannerTealTemplate.vue';
import BannerSlateTemplate from '@/Components/Templates/BannerSlateTemplate.vue';
import IconAccentBlueTemplate from '@/Components/Templates/IconAccentBlueTemplate.vue';
import IconAccentCoralTemplate from '@/Components/Templates/IconAccentCoralTemplate.vue';
import IconAccentOliveTemplate from '@/Components/Templates/IconAccentOliveTemplate.vue';
import LedgerCharcoalTemplate from '@/Components/Templates/LedgerCharcoalTemplate.vue';
import LedgerSteelTemplate from '@/Components/Templates/LedgerSteelTemplate.vue';
import LedgerSandTemplate from '@/Components/Templates/LedgerSandTemplate.vue';
import PortfolioMagentaTemplate from '@/Components/Templates/PortfolioMagentaTemplate.vue';
import PortfolioCyanTemplate from '@/Components/Templates/PortfolioCyanTemplate.vue';
import PortfolioAmberTemplate from '@/Components/Templates/PortfolioAmberTemplate.vue';
import SplitHeaderIndigoTemplate from '@/Components/Templates/SplitHeaderIndigoTemplate.vue';
import SplitHeaderEmeraldTemplate from '@/Components/Templates/SplitHeaderEmeraldTemplate.vue';
import SplitHeaderMaroonTemplate from '@/Components/Templates/SplitHeaderMaroonTemplate.vue';
import CardSkyTemplate from '@/Components/Templates/CardSkyTemplate.vue';
import CardLimeTemplate from '@/Components/Templates/CardLimeTemplate.vue';
import CardGrapeTemplate from '@/Components/Templates/CardGrapeTemplate.vue';
import RibbonRubyTemplate from '@/Components/Templates/RibbonRubyTemplate.vue';
import RibbonCobaltTemplate from '@/Components/Templates/RibbonCobaltTemplate.vue';
import RibbonMustardTemplate from '@/Components/Templates/RibbonMustardTemplate.vue';
import StackedPlumTemplate from '@/Components/Templates/StackedPlumTemplate.vue';
import StackedTealTemplate from '@/Components/Templates/StackedTealTemplate.vue';
import StackedGrayTemplate from '@/Components/Templates/StackedGrayTemplate.vue';
import FrameNavyTemplate from '@/Components/Templates/FrameNavyTemplate.vue';
import FrameBronzeTemplate from '@/Components/Templates/FrameBronzeTemplate.vue';
import FrameForestTemplate from '@/Components/Templates/FrameForestTemplate.vue';
import DiagonalTemplate from '@/Components/Templates/DiagonalTemplate.vue';
import NewspaperTemplate from '@/Components/Templates/NewspaperTemplate.vue';
import BadgeTemplate from '@/Components/Templates/BadgeTemplate.vue';
import UnderlineTemplate from '@/Components/Templates/UnderlineTemplate.vue';
import GridblockTemplate from '@/Components/Templates/GridblockTemplate.vue';
import WatermarkTemplate from '@/Components/Templates/WatermarkTemplate.vue';
import TerminalTemplate from '@/Components/Templates/TerminalTemplate.vue';
import BoxedTabTemplate from '@/Components/Templates/BoxedTabTemplate.vue';
import ZigzagTemplate from '@/Components/Templates/ZigzagTemplate.vue';
import DossierTemplate from '@/Components/Templates/DossierTemplate.vue';

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
    bold: BoldTemplate,
    corporate: CorporateTemplate,
    timeline: TimelineTemplate,
    infographic: InfographicTemplate,
    monochrome: MonochromeTemplate,
    photo: PhotoTemplate,
    twocolumn: TwoColumnTemplate,
    academic: AcademicTemplate,
    startup: StartupTemplate,
    swiss: SwissTemplate,
    sidebarnavy: SidebarNavyTemplate,
    sidebarforest: SidebarForestTemplate,
    sidebarplum: SidebarPlumTemplate,
    bannercrimson: BannerCrimsonTemplate,
    bannerteal: BannerTealTemplate,
    bannerslate: BannerSlateTemplate,
    iconaccentblue: IconAccentBlueTemplate,
    iconaccentcoral: IconAccentCoralTemplate,
    iconaccentolive: IconAccentOliveTemplate,
    ledgercharcoal: LedgerCharcoalTemplate,
    ledgersteel: LedgerSteelTemplate,
    ledgersand: LedgerSandTemplate,
    portfoliomagenta: PortfolioMagentaTemplate,
    portfoliocyan: PortfolioCyanTemplate,
    portfolioamber: PortfolioAmberTemplate,
    splitheaderindigo: SplitHeaderIndigoTemplate,
    splitheaderemerald: SplitHeaderEmeraldTemplate,
    splitheadermaroon: SplitHeaderMaroonTemplate,
    cardsky: CardSkyTemplate,
    cardlime: CardLimeTemplate,
    cardgrape: CardGrapeTemplate,
    ribbonruby: RibbonRubyTemplate,
    ribboncobalt: RibbonCobaltTemplate,
    ribbonmustard: RibbonMustardTemplate,
    stackedplum: StackedPlumTemplate,
    stackedteal: StackedTealTemplate,
    stackedgray: StackedGrayTemplate,
    framenavy: FrameNavyTemplate,
    framebronze: FrameBronzeTemplate,
    frameforest: FrameForestTemplate,
    diagonal: DiagonalTemplate,
    newspaper: NewspaperTemplate,
    badge: BadgeTemplate,
    underline: UnderlineTemplate,
    gridblock: GridblockTemplate,
    watermark: WatermarkTemplate,
    terminal: TerminalTemplate,
    boxedtab: BoxedTabTemplate,
    zigzag: ZigzagTemplate,
    dossier: DossierTemplate,
};
