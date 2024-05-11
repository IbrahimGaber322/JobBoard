<?php

namespace App\Http\Controllers;

use App\Models\jobportal;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function create()
    {
        $userId = auth()->id();
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
            // 'emp_id' => 'exists:users,id',
            // 'no_of_candidates' => 'integer',
            'deadline' => 'date',
            'company_name' => 'required|string'
        ]);
        
        echo "byeee";

        $userId = auth()->id(); // Get the authenticated user's ID

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
            // 'emp_id' => $request->emp_id,
            'emp_id' => $userId, // Assign emp_id to the logged-in user's ID
            // 'no_of_candidates' => $request->no_of_candidates,
            'deadline' => $request->deadline,
            'company_name' => $request->company_name,
        ]);

        return redirect()->route('job.create')->with('success', 'Job created successfully.');
    }

    public function employerJobs(Request $request)
    {
        $userId = $request->user()->id;
        $jobs = jobportal::where('emp_id', $userId)->get();
        return Inertia::render('Job/Jobs', ['jobs' => $jobs]);
    }

    public function Jobs(Request $request)
    {
        $jobs = jobportal::all();
        return Inertia::render('Job/Jobs', ['jobs' => $jobs]);
    }

    // public function show($id)
    // {
    //     $job = jobportal::findOrFail($id);

    //     return Inertia::render('Job/ShowJob', ['job' => $job]);
    // }

    // public function show($id)
    // {
    //     $job = jobportal::findOrFail($id);
        
    //     // Check if the user is authenticated before accessing their role
    //     if (auth()->check()) {
    //         $userRole = auth()->user()->role;
    //     } else {
    //         // If the user is not authenticated, set the role to null or any default value
    //         $userRole = null;
    //     }
    
    //     return Inertia::render('Job/ShowJob', ['job' => $job, 'userRole' => $userRole]);
    // }
    public function show($id)
{
    $job = jobportal::findOrFail($id);

    // Check if the user is authenticated before accessing their role and ID
    if (auth()->check()) {
        $user = auth()->user();
        $userRole = $user->role;
        $userId = $user->id;

        // Check if the user is an employer and if their ID matches the job's employer ID
        $isEmployer = $userRole === 'employer' && $job->emp_id === $userId;
    } else {
        // If the user is not authenticated, set the role to null or any default value
        $userRole = null;
        $isEmployer = false;
    }

    return Inertia::render('Job/ShowJob', ['job' => $job, 'userRole' => $userRole, 'isEmployer' => $isEmployer]);
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
            return redirect()->route('job.employerJobs')->with('success', 'Job deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting job:', $e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while deleting the job. Please try again.']);
        }
    }

    public function update(Request $request, $id)
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
            'deadline' => 'date',
            'company_name' => 'string',
        ]);

        try {
            $job = jobportal::findOrFail($id);
            $job->update($request->all());
            return redirect()->route('job.edit', $job->id)->with('success', 'Job updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating job:', $e);
            return back()->withInput()->withErrors(['error' => 'An error occurred while updating the job. Please try again.']);
        }
    }
}
