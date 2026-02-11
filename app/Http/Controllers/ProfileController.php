<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\NewAvatarRequest;
use Illuminate\View\View;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    use ImageUploadTrait;

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

   public function changeAvatar(NewAvatarRequest $request)
    {
        $user = Auth::user();
        
        // Obriši staru sliku ako postoji
        if ($user->image !== null && $user->image !== 'default.png') {
            $this->deleteImage($user->image, 'images/avatars');
        }
        
        // Upload nove slike
        $imageName = $this->uploadImage($request->file('profile_image'), 'images/avatars');
        
        // Ažuriraj bazu
        $user->update(['image' => $imageName]);

        return redirect()
            ->route('profile.edit')
            ->with('status', 'avatar-updated');
    }

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