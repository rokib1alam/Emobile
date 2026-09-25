<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        // Attempt authentication
        try {
            $request->authenticate(); // This will throw an error if admin is not approved

            // If successful, regenerate session
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails (like not approved), return to login with an error message
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'আপনার অ্যাকাউন্ট এখনও অনুমোদিত নয়। অনুগ্রহ করে অনুমোদনের জন্য অপেক্ষা করুন।']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
