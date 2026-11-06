<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    public function view(User $user, Company $company): bool
    {
        return $user->isSuperadmin() || $company->owner_id === $user->getKey();
    }

    public function update(User $user, Company $company): bool
    {
        return $user->isSuperadmin() || $company->owner_id === $user->getKey();
    }
}
