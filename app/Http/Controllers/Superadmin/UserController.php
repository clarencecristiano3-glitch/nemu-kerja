<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('superadmin.users.index', [
            'users' => User::query()->withCount('companies')->latest()->paginate(20),
        ]);
    }
}
