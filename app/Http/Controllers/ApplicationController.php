<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;



class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Applications/submit');
    }

    public function create()
    {
        return inertia('Applications/create');
    }

    public function store(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'jobId' => 'required',
        ]);

        Application::create([
            'user_id' => $userID,
            'job_id' => $request->jobId,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Application created successfully!');
    }
}
