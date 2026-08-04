<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'name', 'description', 'price', 'is_active', 'sort_order'])]
class ResumeTemplate extends Model
{
    /**
     * Design keys with a matching Vue component in resources/js/Components/Templates.
     *
     * @var array<int, string>
     */
    public const AVAILABLE_KEYS = [
        'modern',
        'classic',
        'minimal',
        'professional',
        'executive',
        'creative',
        'student',
        'compact',
        'elegant',
        'technical',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
