<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        abort_unless($user instanceof User, 403);

        $user->loadCount([
            'jobApplications',
            'jobApplications as accepted_applications_count' => static fn (Builder $query) => $query
                ->where('status', JobApplication::STATUS_REVIEWED),
        ]);

        return view('profile.show', [
            'user' => $user,
            'applications' => $user->jobApplications()
                ->with(['vacancy.company'])
                ->latest()
                ->paginate(10),
        ]);
    }
}
