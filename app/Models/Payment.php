<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'resume_template_id',
    'customer_name',
    'customer_email',
    'amount',
    'method',
    'status',
    'reference',
    'paid_at',
    'pdf_uploaded_at',
    'pdf_path',
])]
class Payment extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_PAID = 'paid';

    public const STATUS_FAILED = 'failed';

    public const STATUS_REFUNDED = 'refunded';

    /**
     * @var array<int, string>
     */
    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_PAID,
        self::STATUS_FAILED,
        self::STATUS_REFUNDED,
    ];

    public function resumeTemplate(): BelongsTo
    {
        return $this->belongsTo(ResumeTemplate::class);
    }

    /**
     * Payments that completed successfully.
     */
    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PAID);
    }

    /**
     * Payments whose PDF has been generated and uploaded.
     */
    public function scopePdfUploaded(Builder $query): Builder
    {
        return $query->whereNotNull('pdf_uploaded_at');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'pdf_uploaded_at' => 'datetime',
        ];
    }
}
