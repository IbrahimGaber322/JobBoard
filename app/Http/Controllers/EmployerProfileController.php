<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


class EmployerProfileController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary();
    }

    public function show(Request $request)
    {
        $user = $request->user();

        return Inertia::render('EmployerProfile/Show', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => $user,
        ]);
    }

    public function edit(Request $request): Response
    {
        $user = $request->user(); 
        return Inertia::render('EmployerProfile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => $user,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {
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
            $request->user()->image = $uploadedImageResponse['secure_url'];
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->fill($request->validated())->save();

        return Redirect::route('employer.profile.show')->with('status', 'Your profile has been updated successfully.');
    }

    public function delete(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        
        if ($user->image) {
            (new UploadApi())->destroy($user->image);
        }  
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();      
        return Redirect::to('/')->with('status', 'Your account has been deleted.');
    }
}

