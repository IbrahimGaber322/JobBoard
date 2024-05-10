<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function create()
    {
        return inertia('Applications/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Application::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Application created successfully!');

    }
}
