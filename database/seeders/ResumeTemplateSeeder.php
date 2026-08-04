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
