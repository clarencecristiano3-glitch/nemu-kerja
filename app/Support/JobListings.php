<?php

namespace App\Support;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Builder;

class JobListings
{
    public const DEFAULT_ID = 3;

    public static function featured(): array
    {
        return array_slice(self::all(), 0, 8);
    }

    public static function management(): array
    {
        return array_values(array_filter(
            self::all(),
            static fn (array $job): bool => in_array($job['id'], [3, 4, 9, 10], true),
        ));
    }

    public static function find(int $id): ?array
    {
        $vacancy = self::publicQuery()->whereKey($id)->first();

        return $vacancy?->toListingArray();
    }

    public static function all(): array
    {
        return self::publicQuery()
            ->latest()
            ->orderByDesc('id')
            ->get()
            ->map(static fn (Vacancy $vacancy): array => $vacancy->toListingArray())
            ->all();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function forCompany(Company $company): array
    {
        return self::publicQuery()
            ->whereBelongsTo($company)
            ->latest()
            ->orderByDesc('id')
            ->get()
            ->map(static fn (Vacancy $vacancy): array => $vacancy->toListingArray())
            ->all();
    }

    /**
     * @return Builder<Vacancy>
     */
    private static function publicQuery(): Builder
    {
        return Vacancy::query()
            ->where('status', 'published')
            ->where(static function ($query): void {
                $query->whereNull('expires_at')->orWhereDate('expires_at', '>=', today());
            })
            ->whereHas('company', static fn ($query) => $query->where('verification_status', 'approved'))
            ->with('company')
            ->withCount('applications');
    }
}
