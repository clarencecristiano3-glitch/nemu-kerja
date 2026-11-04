<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'name',
    'slug',
    'legal_name',
    'region',
    'owner_name',
    'outlets_count',
    'logo_path',
    'verification_status',
    'submitted_by',
    'reviewed_by',
    'review_note',
    'verified_at',
])]
class Company extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo_path === null) {
            return null;
        }

        if (str_starts_with($this->logo_path, 'images/')) {
            return asset($this->logo_path);
        }

        return Storage::disk('public')->url($this->logo_path);
    }
}
