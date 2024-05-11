<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Log;

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

    public function show(Request $request): Response
    {
        $user = $request->user();

        //employer profile view named "Profile/Show"
        return Inertia::render('EmployerProfile/Show', [
            'user' => $user,
        ]);
    }
}
