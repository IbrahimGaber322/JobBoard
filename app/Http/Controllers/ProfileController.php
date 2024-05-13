<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Cloudinary\Cloudinary;
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

    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary();
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
            Log::channel('stderr')->info('image url');
            $uploadedImageResponse = (new UploadApi())->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'profile_images',
                    'transformation' => [
                        'width' => 500,
                        'height' => 500,
                        'crop' => 'limit'
                    ]
                ]
            );
            Log::channel('stderr')->info('image url', ['image' => $uploadedImageResponse]);
            $request->user()->image = $uploadedImageResponse['secure_url'];
        }

        if ($request->hasFile('resume')) {
            $uploadedFileResponse = (new UploadApi())->upload(
                $request->file('resume')->getRealPath(),
                [
                    'folder' => 'user_resumes',
                    'resource_type' => 'raw'
                ]
            );
            $request->user()->resume = $uploadedFileResponse['secure_url'];
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
