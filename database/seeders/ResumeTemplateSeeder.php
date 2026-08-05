<?php

namespace Database\Seeders;

use App\Models\ResumeTemplate;
use Illuminate\Database\Seeder;

class ResumeTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            // Original 20
            ['key' => 'modern', 'name' => 'Modern', 'description' => 'Clean and contemporary, ideal for most industries.', 'price' => 49, 'recommended_roles' => ['Marketing', 'Sales', 'General / Any Field']],
            ['key' => 'classic', 'name' => 'Classic', 'description' => 'Traditional serif layout trusted by recruiters.', 'price' => 49, 'recommended_roles' => ['Legal Assistant', 'Government', 'Corporate Executive']],
            ['key' => 'minimal', 'name' => 'Minimal', 'description' => 'Understated, whitespace-first design.', 'price' => 39, 'recommended_roles' => ['Software Engineer', 'Data Analyst', 'UX/UI Designer']],
            ['key' => 'professional', 'name' => 'Professional', 'description' => 'Two-column layout with a dedicated sidebar.', 'price' => 59, 'recommended_roles' => ['Business Analyst', 'Operations Manager', 'Accountant']],
            ['key' => 'executive', 'name' => 'Executive', 'description' => 'Bold and refined, built for senior roles.', 'price' => 69, 'recommended_roles' => ['Corporate Executive', 'Director', 'Senior Management']],
            ['key' => 'creative', 'name' => 'Creative', 'description' => 'Colorful and expressive, great for designers.', 'price' => 59, 'recommended_roles' => ['Graphic Designer', 'Content Creator', 'Social Media Manager']],
            ['key' => 'student', 'name' => 'Student', 'description' => 'Education-first layout for new grads and interns.', 'price' => 39, 'recommended_roles' => ['Fresh Graduate', 'Intern', 'Entry-Level']],
            ['key' => 'compact', 'name' => 'Compact', 'description' => 'Dense layout that fits more onto one page.', 'price' => 49, 'recommended_roles' => ['Retail Associate', 'Customer Service Representative', 'Virtual Assistant']],
            ['key' => 'elegant', 'name' => 'Elegant', 'description' => 'Soft, refined typography with a light touch.', 'price' => 59, 'recommended_roles' => ['Hospitality', 'Event Coordinator', 'Fashion']],
            ['key' => 'technical', 'name' => 'Technical', 'description' => 'Monospace accents, built for developers & engineers.', 'price' => 49, 'recommended_roles' => ['Software Engineer', 'IT Support', 'Web Developer']],
            ['key' => 'bold', 'name' => 'Bold', 'description' => 'High-contrast black and white, impossible to overlook.', 'price' => 55, 'recommended_roles' => ['Sales', 'Marketing', 'Real Estate Agent']],
            ['key' => 'corporate', 'name' => 'Corporate', 'description' => 'Formal navy header band, built for traditional industries.', 'price' => 49, 'recommended_roles' => ['Finance', 'Banking', 'Corporate Executive']],
            ['key' => 'timeline', 'name' => 'Timeline', 'description' => 'A vertical timeline layout for a clear career story.', 'price' => 55, 'recommended_roles' => ['Project Manager', 'Operations Manager', 'HR Specialist']],
            ['key' => 'infographic', 'name' => 'Infographic', 'description' => 'Icon-led sections with a graphic, visual feel.', 'price' => 59, 'recommended_roles' => ['Marketing', 'Social Media Manager', 'Graphic Designer']],
            ['key' => 'monochrome', 'name' => 'Monochrome', 'description' => 'Stark black-and-white, poster-style section dividers.', 'price' => 49, 'recommended_roles' => ['Legal Assistant', 'Consulting', 'Corporate Executive']],
            ['key' => 'photo', 'name' => 'Photo', 'description' => 'A bold photo banner header for a personal touch.', 'price' => 55, 'recommended_roles' => ['Virtual Assistant', 'Customer Service Representative', 'Sales']],
            ['key' => 'twocolumn', 'name' => 'Two-Column', 'description' => 'Light two-column layout with a dedicated info rail.', 'price' => 59, 'recommended_roles' => ['Business Analyst', 'Data Analyst', 'HR Specialist']],
            ['key' => 'academic', 'name' => 'Academic', 'description' => 'Dense, numbered CV format suited for research & academia.', 'price' => 49, 'recommended_roles' => ['Teacher', 'Researcher', 'Professor']],
            ['key' => 'startup', 'name' => 'Startup', 'description' => 'Playful gradient header with a modern, friendly feel.', 'price' => 55, 'recommended_roles' => ['Startup / Founder', 'Product Manager', 'Marketing']],
            ['key' => 'swiss', 'name' => 'Swiss', 'description' => 'Strict grid, bold type, a single accent — Swiss design style.', 'price' => 59, 'recommended_roles' => ['Architect', 'Engineer', 'Designer']],

            // 30 new templates: 10 layout families x 3 color themes
            ['key' => 'sidebarnavy', 'name' => 'Sidebar Navy', 'description' => 'Dark navy sidebar for contact & skills, clean content column.', 'price' => 49, 'recommended_roles' => ['Virtual Assistant', 'Administrative Assistant', 'Customer Service Representative']],
            ['key' => 'sidebarforest', 'name' => 'Sidebar Forest', 'description' => 'Dark forest-green sidebar for contact & skills, clean content column.', 'price' => 49, 'recommended_roles' => ['Virtual Assistant', 'Administrative Assistant', 'Customer Service Representative']],
            ['key' => 'sidebarplum', 'name' => 'Sidebar Plum', 'description' => 'Dark plum sidebar for contact & skills, clean content column.', 'price' => 49, 'recommended_roles' => ['Virtual Assistant', 'Administrative Assistant', 'Customer Service Representative']],

            ['key' => 'bannercrimson', 'name' => 'Banner Crimson', 'description' => 'Full-width crimson header banner with a confident, single-column body.', 'price' => 49, 'recommended_roles' => ['Sales Associate', 'Marketing Specialist', 'Real Estate Agent']],
            ['key' => 'bannerteal', 'name' => 'Banner Teal', 'description' => 'Full-width teal header banner with a confident, single-column body.', 'price' => 49, 'recommended_roles' => ['Sales Associate', 'Marketing Specialist', 'Real Estate Agent']],
            ['key' => 'bannerslate', 'name' => 'Banner Slate', 'description' => 'Full-width slate header banner with a confident, single-column body.', 'price' => 49, 'recommended_roles' => ['Sales Associate', 'Marketing Specialist', 'Real Estate Agent']],

            ['key' => 'iconaccentblue', 'name' => 'Icon Accent Blue', 'description' => 'Single column with blue icon-labeled section headings.', 'price' => 49, 'recommended_roles' => ['Software Engineer', 'IT Support', 'Web Developer']],
            ['key' => 'iconaccentcoral', 'name' => 'Icon Accent Coral', 'description' => 'Single column with coral icon-labeled section headings.', 'price' => 49, 'recommended_roles' => ['Software Engineer', 'IT Support', 'Web Developer']],
            ['key' => 'iconaccentolive', 'name' => 'Icon Accent Olive', 'description' => 'Single column with olive icon-labeled section headings.', 'price' => 49, 'recommended_roles' => ['Software Engineer', 'IT Support', 'Web Developer']],

            ['key' => 'ledgercharcoal', 'name' => 'Ledger Charcoal', 'description' => 'Minimal, ATS-safe ledger rows in charcoal — built to be parsed cleanly.', 'price' => 39, 'recommended_roles' => ['Accountant', 'Bookkeeper', 'Financial Analyst']],
            ['key' => 'ledgersteel', 'name' => 'Ledger Steel', 'description' => 'Minimal, ATS-safe ledger rows in steel gray — built to be parsed cleanly.', 'price' => 39, 'recommended_roles' => ['Accountant', 'Bookkeeper', 'Financial Analyst']],
            ['key' => 'ledgersand', 'name' => 'Ledger Sand', 'description' => 'Minimal, ATS-safe ledger rows in warm sand — built to be parsed cleanly.', 'price' => 39, 'recommended_roles' => ['Accountant', 'Bookkeeper', 'Financial Analyst']],

            ['key' => 'portfoliomagenta', 'name' => 'Portfolio Magenta', 'description' => 'Photo-forward layout with a magenta name badge and filled skill chips.', 'price' => 59, 'recommended_roles' => ['Graphic Designer', 'Social Media Manager', 'Content Creator']],
            ['key' => 'portfoliocyan', 'name' => 'Portfolio Cyan', 'description' => 'Photo-forward layout with a cyan name badge and filled skill chips.', 'price' => 59, 'recommended_roles' => ['Graphic Designer', 'Social Media Manager', 'Content Creator']],
            ['key' => 'portfolioamber', 'name' => 'Portfolio Amber', 'description' => 'Photo-forward layout with an amber name badge and filled skill chips.', 'price' => 59, 'recommended_roles' => ['Graphic Designer', 'Social Media Manager', 'Content Creator']],

            ['key' => 'splitheaderindigo', 'name' => 'Split Header Indigo', 'description' => 'Header split into name and contact halves in indigo, single column below.', 'price' => 55, 'recommended_roles' => ['Project Manager', 'HR Specialist', 'Business Analyst']],
            ['key' => 'splitheaderemerald', 'name' => 'Split Header Emerald', 'description' => 'Header split into name and contact halves in emerald, single column below.', 'price' => 55, 'recommended_roles' => ['Project Manager', 'HR Specialist', 'Business Analyst']],
            ['key' => 'splitheadermaroon', 'name' => 'Split Header Maroon', 'description' => 'Header split into name and contact halves in maroon, single column below.', 'price' => 55, 'recommended_roles' => ['Project Manager', 'HR Specialist', 'Business Analyst']],

            ['key' => 'cardsky', 'name' => 'Card Sky', 'description' => 'Sections rendered as clean boxed cards with a sky-blue accent.', 'price' => 55, 'recommended_roles' => ['Product Manager', 'UX/UI Designer', 'Customer Success']],
            ['key' => 'cardlime', 'name' => 'Card Lime', 'description' => 'Sections rendered as clean boxed cards with a lime accent.', 'price' => 55, 'recommended_roles' => ['Product Manager', 'UX/UI Designer', 'Customer Success']],
            ['key' => 'cardgrape', 'name' => 'Card Grape', 'description' => 'Sections rendered as clean boxed cards with a grape accent.', 'price' => 55, 'recommended_roles' => ['Product Manager', 'UX/UI Designer', 'Customer Success']],

            ['key' => 'ribbonruby', 'name' => 'Ribbon Ruby', 'description' => 'Warm, approachable layout with a ruby left-border ribbon per section.', 'price' => 49, 'recommended_roles' => ['Teacher', 'Nurse', 'Caregiver']],
            ['key' => 'ribboncobalt', 'name' => 'Ribbon Cobalt', 'description' => 'Warm, approachable layout with a cobalt left-border ribbon per section.', 'price' => 49, 'recommended_roles' => ['Teacher', 'Nurse', 'Caregiver']],
            ['key' => 'ribbonmustard', 'name' => 'Ribbon Mustard', 'description' => 'Warm, approachable layout with a mustard left-border ribbon per section.', 'price' => 49, 'recommended_roles' => ['Teacher', 'Nurse', 'Caregiver']],

            ['key' => 'stackedplum', 'name' => 'Stacked Plum', 'description' => 'Centered name with a stacked plum contact-pill row and light dividers.', 'price' => 45, 'recommended_roles' => ['Hospitality', 'Retail Associate', 'Event Coordinator']],
            ['key' => 'stackedteal', 'name' => 'Stacked Teal', 'description' => 'Centered name with a stacked teal contact-pill row and light dividers.', 'price' => 45, 'recommended_roles' => ['Hospitality', 'Retail Associate', 'Event Coordinator']],
            ['key' => 'stackedgray', 'name' => 'Stacked Gray', 'description' => 'Centered name with a stacked gray contact-pill row and light dividers.', 'price' => 45, 'recommended_roles' => ['Hospitality', 'Retail Associate', 'Event Coordinator']],

            ['key' => 'framenavy', 'name' => 'Frame Navy', 'description' => 'Formal full-page navy border frame with serif headings.', 'price' => 59, 'recommended_roles' => ['Legal Assistant', 'Government', 'Corporate Executive']],
            ['key' => 'framebronze', 'name' => 'Frame Bronze', 'description' => 'Formal full-page bronze border frame with serif headings.', 'price' => 59, 'recommended_roles' => ['Legal Assistant', 'Government', 'Corporate Executive']],
            ['key' => 'frameforest', 'name' => 'Frame Forest', 'description' => 'Formal full-page forest-green border frame with serif headings.', 'price' => 59, 'recommended_roles' => ['Legal Assistant', 'Government', 'Corporate Executive']],

            // 10 more distinct one-off designs
            ['key' => 'diagonal', 'name' => 'Diagonal', 'description' => 'A skewed cyan band cuts behind the header for a dynamic, energetic feel.', 'price' => 49, 'recommended_roles' => ['Sales Representative', 'Marketing Specialist', 'Business Development']],
            ['key' => 'newspaper', 'name' => 'Newspaper', 'description' => 'A masthead-style header with two-column newsprint body text and rule lines.', 'price' => 45, 'recommended_roles' => ['Journalist', 'Content Writer', 'Editor']],
            ['key' => 'badge', 'name' => 'Badge', 'description' => 'A circular initials badge and rounded skill badges for a friendly, approachable look.', 'price' => 49, 'recommended_roles' => ['Customer Support', 'Community Manager', 'Social Media Manager']],
            ['key' => 'underline', 'name' => 'Underline', 'description' => 'A bold underlined name with numbered section headings for a confident, structured read.', 'price' => 49, 'recommended_roles' => ['Consultant', 'Business Analyst', 'Operations Manager']],
            ['key' => 'gridblock', 'name' => 'Gridblock', 'description' => 'Header contact details laid out as labeled grid cells, built for data-minded roles.', 'price' => 55, 'recommended_roles' => ['Data Analyst', 'Research Analyst', 'Data Scientist']],
            ['key' => 'watermark', 'name' => 'Watermark', 'description' => 'A faint oversized initials watermark sits behind an elegant, understated header.', 'price' => 59, 'recommended_roles' => ['Architect', 'Interior Designer', 'Photographer']],
            ['key' => 'terminal', 'name' => 'Terminal', 'description' => 'A dark, monospace code-editor theme with $ prompt section headers, built for developers.', 'price' => 49, 'recommended_roles' => ['Software Engineer', 'DevOps Engineer', 'Backend Developer']],
            ['key' => 'boxedtab', 'name' => 'Boxed Tab', 'description' => 'Section headings sit inside solid colored tabs for a bold, organized structure.', 'price' => 55, 'recommended_roles' => ['Product Manager', 'Program Manager', 'Scrum Master']],
            ['key' => 'zigzag', 'name' => 'Zigzag', 'description' => 'Section headings alternate left and right for a playful, editorial layout.', 'price' => 55, 'recommended_roles' => ['Graphic Designer', 'Art Director', 'Creative Director']],
            ['key' => 'dossier', 'name' => 'Dossier', 'description' => 'A rotated side tab gives this warm, kraft-toned layout a case-file feel.', 'price' => 49, 'recommended_roles' => ['Investigator', 'Paralegal', 'Compliance Officer']],
        ];

        foreach ($templates as $index => $template) {
            ResumeTemplate::updateOrCreate(
                ['key' => $template['key']],
                [
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'recommended_roles' => $template['recommended_roles'],
                    'price' => $template['price'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
