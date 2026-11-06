<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;

class VacancyPolicy
{
    public function view(User $user, Vacancy $vacancy): bool
    {
        return $user->isSuperadmin()
            || ($user->isCompanyAdmin() && $vacancy->company?->owner_id === $user->getKey());
    }

    public function update(User $user, Vacancy $vacancy): bool
    {
        return $this->view($user, $vacancy);
    }

    public function delete(User $user, Vacancy $vacancy): bool
    {
        return $this->view($user, $vacancy);
    }
}
