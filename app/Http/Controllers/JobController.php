<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jobportal;
use Inertia\Inertia;

class JobController extends Controller
{
    public function create()
    {
        return Inertia::render('Job/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'experience_level' => 'string',
            'responsibilities' => 'string',
            'skills' => 'string',
            'salary_range' => 'string',
            'date' => 'date',
            'category' => 'string',
            'location' => 'string',
            'work_type' => 'string',
            'status' => 'string',
            'emp_id' => 'exists:users,id',
            'no_of_candidates' => 'integer',
            'deadline' => 'date',
            
        ]);

        $job = jobportal::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'experience_level' => $request->experience_level,
            'responsibilities' => $request->responsibilities,
            'skills' => $request->skills,
            'salary_range' => $request->salary_range,
            'date' => $request->date,
            'category' => $request->category,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'status' => $request->status,
            'emp_id' => $request->emp_id,
            'no_of_candidates' => $request->no_of_candidates,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('job.create')->with('success', 'Job created successfully.');
    }
}
