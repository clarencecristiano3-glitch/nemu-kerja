<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;

class JobApplicationPolicy
{
    public function view(User $user, JobApplication $jobApplication): bool
    {
        return $user->isSuperadmin()
            || ($user->isCompanyAdmin()
                && $jobApplication->vacancy?->company?->owner_id === $user->getKey());
    }

    public function update(User $user, JobApplication $jobApplication): bool
    {
        return $this->view($user, $jobApplication);
    }
}
