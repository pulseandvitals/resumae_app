<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['key', 'name', 'description', 'recommended_roles', 'price', 'is_active', 'sort_order'])]
class ResumeTemplate extends Model
{
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

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
        'bold',
        'corporate',
        'timeline',
        'infographic',
        'monochrome',
        'photo',
        'twocolumn',
        'academic',
        'startup',
        'swiss',
        'sidebarnavy',
        'sidebarforest',
        'sidebarplum',
        'bannercrimson',
        'bannerteal',
        'bannerslate',
        'iconaccentblue',
        'iconaccentcoral',
        'iconaccentolive',
        'ledgercharcoal',
        'ledgersteel',
        'ledgersand',
        'portfoliomagenta',
        'portfoliocyan',
        'portfolioamber',
        'splitheaderindigo',
        'splitheaderemerald',
        'splitheadermaroon',
        'cardsky',
        'cardlime',
        'cardgrape',
        'ribbonruby',
        'ribboncobalt',
        'ribbonmustard',
        'stackedplum',
        'stackedteal',
        'stackedgray',
        'framenavy',
        'framebronze',
        'frameforest',
        'diagonal',
        'newspaper',
        'badge',
        'underline',
        'gridblock',
        'watermark',
        'terminal',
        'boxedtab',
        'zigzag',
        'dossier',
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
            'recommended_roles' => 'array',
        ];
    }
}
