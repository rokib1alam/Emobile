<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        // $this->middleware('auth');
        $this->toastr = $toastr;
    }
    /**
     * Display a listing of the resource.
     */

    /**
     * Update the user's profile information.
     */

    public function update(Request $request, User $profile)
    {
        User::updateUser($request, $profile->id);

        $this->toastr->success('Profile updated successfully!');
        return back(); // Redirect to the list of properties
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
