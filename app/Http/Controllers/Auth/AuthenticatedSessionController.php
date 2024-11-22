<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Role_user;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        //dd(Auth::user()->id);
        $user_id = Auth::user()->id;
        $role_user = Role_user::where('user_id', $user_id)->first();
        if($role_user->role_id == '1'){
            return redirect()->intended(route('panel.dashboard', absolute: false));
        }
        else if($role_user->role_id == '2'){
            return redirect()->intended(route('panel.staff', absolute: false));
        }
        else {
            $redirect_to = '/';
            return redirect($redirect_to);
        }
        // if(Auth::user()->hasRole(['admin'])){
        //     return redirect()->intended(route('panel.dashboard', absolute: false));
        // }else if(Auth::user()->hasRole(['staff'])){
        //     return redirect()->intended(route('panel.staff', absolute: false));
        // }
        // else {
        //     $redirect_to = '/';
        //     return redirect($redirect_to);
        // }
       
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
