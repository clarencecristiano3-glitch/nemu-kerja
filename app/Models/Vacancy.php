<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'created_by',
    'title',
    'position',
    'employment_type',
    'category',
    'minimum_education',
    'maximum_age',
    'needed',
    'quota',
    'location',
    'address',
    'description',
    'responsibilities',
    'qualifications',
    'schedule',
    'benefits',
    'expires_at',
    'status',
])]
class Vacancy extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'responsibilities' => 'array',
            'qualifications' => 'array',
            'schedule' => 'array',
            'benefits' => 'array',
            'expires_at' => 'date',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_listing_id');
    }

    /**
     * @return array<string, mixed>
     */
    public function toListingArray(): array
    {
        $company = $this->company;

        return [
            'id' => $this->getKey(),
            'company_id' => $company->getKey(),
            'company' => $company->name,
            'brand' => $company->name,
            'title' => $this->title,
            'type' => $this->employment_type,
            'position' => $this->position,
            'education' => $this->minimum_education,
            'age' => $this->maximum_age,
            'needed' => $this->needed,
            'location' => $this->location,
            'company_location' => $this->address ?: $this->location,
            'company_pt' => $company->legal_name ?: $company->name,
            'category' => $this->category,
            'logo' => $company->name,
            'logoClass' => 'text-[#151442]',
            'image' => $company->logo_url,
            'logoBackground' => $company->slug === 'hotways-chicken',
            'applicants' => (int) ($this->applications_count ?? 0),
            'quota' => $this->quota,
            'remaining_days' => $this->expires_at === null
                ? 0
                : max(0, (int) today()->diffInDays($this->expires_at, false)),
            'description' => $this->description,
            'responsibilities' => $this->responsibilities ?: [$this->description],
            'qualifications' => $this->qualifications ?: ["Pendidikan minimal {$this->minimum_education}.", 'Mampu bekerja sama dengan tim.'],
            'schedule' => $this->schedule ?: ["Sistem kerja: {$this->employment_type}."],
            'benefits' => $this->benefits ?: ['Kompensasi sesuai posisi dan pengalaman.'],
        ];
    }
}
