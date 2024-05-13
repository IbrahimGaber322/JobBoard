<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\CloudinaryService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        Log::channel('stderr')->info($request->all());

        if ($request->hasFile('image')) {
            $uploadedImageResponse = $this->cloudinaryService->uploadImage($request->file('image'));
            $request->user()->image = $uploadedImageResponse['secure_url'];
        }

        if ($request->hasFile('resume')) {
            $uploadedResumeResponse = $this->cloudinaryService->uploadResume($request->file('resume'));
            $request->user()->resume = $uploadedResumeResponse['secure_url'];
        }

        $request->user()->fill($request->except(['image', 'resume']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->image) {
            (new UploadApi())->destroy($user->image);
        }

        if ($user->resume) {
            (new UploadApi())->destroy($user->resume);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
