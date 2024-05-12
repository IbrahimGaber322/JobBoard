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

    // public function edit(Request $request): Response
    // {
    //     return Inertia::render('EmployerProfile/Edit', [
    //         'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
    //         'status' => session('status'),
    //     ]);
    // }

    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {        
    //     return Redirect::route('employer.profile.edit');
    // }

    // public function destroy(Request $request): RedirectResponse
    // {        
    //     return Redirect::to('/');
    // }

    public function show(Request $request)
    {
        $user = $request->user();

        return Inertia::render('EmployerProfile/Show', [
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
        // Handle image upload
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

        // Handle email verification status update
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Fill the user model with the request data and save changes
        $request->user()->fill($request->validated())->save();

        return Redirect::route('employer.profile.edit')->with('status', 'Profile updated successfully.');
    }
}
