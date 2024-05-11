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
            // 'date' => 'date',
            'category' => 'string',
            'location' => 'string',
            'work_type' => 'required|string|in:hybrid,remote,onsite',
            // 'status' => 'string',
            'emp_id' => 'exists:users,id',
            // 'no_of_candidates' => 'integer',
            'deadline' => 'date',
            'company_name' => 'required|string'
            
        ]);

        $job = jobportal::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'experience_level' => $request->experience_level,
            'responsibilities' => $request->responsibilities,
            'skills' => $request->skills,
            'salary_range' => $request->salary_range,
            // 'date' => $request->date,
            'category' => $request->category,
            'location' => $request->location,
            'work_type' => $request->work_type,
            // 'status' => $request->status,
            'emp_id' => $request->emp_id,
            // 'no_of_candidates' => $request->no_of_candidates,
            'deadline' => $request->deadline,
            'company_name' => $request->company_name,

        ]);

        return redirect()->route('job.create')->with('success', 'Job created successfully.');
    }
    public function index()
    {
        $jobs = jobportal::all();
        return Inertia::render('Job/Jobs', ['jobs' => $jobs]); // Adjusted the view name to 'Job/Jobs'
    }
    public function show($id)
    {
        $job = jobportal::findOrFail($id);
        return Inertia::render('Job/ShowJob', ['job' => $job]);
    }

    public function edit($id)
{
    $job = jobportal::findOrFail($id);
    return Inertia::render('Job/EditJob', ['job' => $job]);
}



public function destroy($id)
{
    try {
        $job = jobportal::findOrFail($id);
        $job->delete();

        return redirect()->route('job.index')->with('success', 'Job deleted successfully.');
    } catch (\Exception $e) {
        \Log::error('Error deleting job:', $e);
        return back()->withInput()->withErrors(['error' => 'An error occurred while deleting the job. Please try again.']);
    }
}

public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'desc' => 'required|string',
        'experience_level' => 'string',
        'responsibilities' => 'string',
        'skills' => 'string',
        'salary_range' => 'string',
        // 'date' => 'date',
        'category' => 'string',
        'location' => 'string',
        'work_type' => 'required|string|in:hybrid,remote,onsite',
        // 'status' => 'string',
        'emp_id' => 'exists:users,id',
        'deadline' => 'date',
        'company_name' => 'string',

    ]);

    try {
        // Find the job by ID
        $job = jobportal::findOrFail($id);

        // Update job details
        $job->update($request->all());

        return redirect()->route('job.edit', $job->id)->with('success', 'Job updated successfully.');
    } catch (\Exception $e) {
        // Log and handle any exceptions
        \Log::error('Error updating job:', $e);
        return back()->withInput()->withErrors(['error' => 'An error occurred while updating the job. Please try again.']);
    }

    
}


}
