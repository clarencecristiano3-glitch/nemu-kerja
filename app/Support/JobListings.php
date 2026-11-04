<?php

namespace App\Support;

use App\Models\Vacancy;

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
        $vacancy = Vacancy::query()
            ->whereKey($id)
            ->where('status', 'published')
            ->where(static function ($query): void {
                $query->whereNull('expires_at')->orWhereDate('expires_at', '>=', today());
            })
            ->whereHas('company', static fn ($query) => $query->where('verification_status', 'approved'))
            ->with('company')
            ->withCount('applications')
            ->first();

        return $vacancy?->toListingArray();
    }

    public static function all(): array
    {
        return Vacancy::query()
            ->where('status', 'published')
            ->where(static function ($query): void {
                $query->whereNull('expires_at')->orWhereDate('expires_at', '>=', today());
            })
            ->whereHas('company', static fn ($query) => $query->where('verification_status', 'approved'))
            ->with('company')
            ->withCount('applications')
            ->latest()
            ->orderByDesc('id')
            ->get()
            ->map(static fn (Vacancy $vacancy): array => $vacancy->toListingArray())
            ->all();
    }
}
