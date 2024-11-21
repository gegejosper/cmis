<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;

abstract class Controller
{
    //
    public function adminDashboard()
    {
        if (Gate::allows('access-admin')) {
            return view('admin.dashboard'); // Admin dashboard view
        }

        abort(403);
    }

    public function staffDashboard()
    {
        if (Gate::allows('access-staff')) {
            return view('staff.dashboard'); // Staff dashboard view
        }

        abort(403);
    }

    public function userDashboard()
    {
        if (Gate::allows('access-user')) {
            return view('user.dashboard'); // User dashboard view
        }

        abort(403);
    }
}
