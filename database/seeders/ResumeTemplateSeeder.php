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
            ['key' => 'modern', 'name' => 'Modern', 'description' => 'Clean and contemporary, ideal for most industries.', 'price' => 49],
            ['key' => 'classic', 'name' => 'Classic', 'description' => 'Traditional serif layout trusted by recruiters.', 'price' => 49],
            ['key' => 'minimal', 'name' => 'Minimal', 'description' => 'Understated, whitespace-first design.', 'price' => 39],
            ['key' => 'professional', 'name' => 'Professional', 'description' => 'Two-column layout with a dedicated sidebar.', 'price' => 59],
            ['key' => 'executive', 'name' => 'Executive', 'description' => 'Bold and refined, built for senior roles.', 'price' => 69],
            ['key' => 'creative', 'name' => 'Creative', 'description' => 'Colorful and expressive, great for designers.', 'price' => 59],
            ['key' => 'student', 'name' => 'Student', 'description' => 'Education-first layout for new grads and interns.', 'price' => 39],
            ['key' => 'compact', 'name' => 'Compact', 'description' => 'Dense layout that fits more onto one page.', 'price' => 49],
            ['key' => 'elegant', 'name' => 'Elegant', 'description' => 'Soft, refined typography with a light touch.', 'price' => 59],
            ['key' => 'technical', 'name' => 'Technical', 'description' => 'Monospace accents, built for developers & engineers.', 'price' => 49],
            ['key' => 'bold', 'name' => 'Bold', 'description' => 'High-contrast black and white, impossible to overlook.', 'price' => 55],
            ['key' => 'corporate', 'name' => 'Corporate', 'description' => 'Formal navy header band, built for traditional industries.', 'price' => 49],
            ['key' => 'timeline', 'name' => 'Timeline', 'description' => 'A vertical timeline layout for a clear career story.', 'price' => 55],
            ['key' => 'infographic', 'name' => 'Infographic', 'description' => 'Icon-led sections with a graphic, visual feel.', 'price' => 59],
            ['key' => 'monochrome', 'name' => 'Monochrome', 'description' => 'Stark black-and-white, poster-style section dividers.', 'price' => 49],
            ['key' => 'photo', 'name' => 'Photo', 'description' => 'A bold photo banner header for a personal touch.', 'price' => 55],
            ['key' => 'twocolumn', 'name' => 'Two-Column', 'description' => 'Light two-column layout with a dedicated info rail.', 'price' => 59],
            ['key' => 'academic', 'name' => 'Academic', 'description' => 'Dense, numbered CV format suited for research & academia.', 'price' => 49],
            ['key' => 'startup', 'name' => 'Startup', 'description' => 'Playful gradient header with a modern, friendly feel.', 'price' => 55],
            ['key' => 'swiss', 'name' => 'Swiss', 'description' => 'Strict grid, bold type, a single accent — Swiss design style.', 'price' => 59],
        ];

        foreach ($templates as $index => $template) {
            ResumeTemplate::updateOrCreate(
                ['key' => $template['key']],
                [
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'price' => $template['price'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
