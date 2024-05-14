<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\jobportal;
use App\Models\User;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;



class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Applications/submit');
    }


    public function store(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'jobId' => 'required',
        ]);
    
        $job = jobportal::findOrFail($request->jobId);
    
        $job->increment('no_of_candidates');
    
        Application::create([
            'user_id' => $userID,
            'job_id' => $request->jobId,
            'emp_id' => $request->empId,
            'status' => 'pending',
        ]);
        
    }

    public function show()
    {
        $employerId = Auth::id();
        $applications = Application::where('emp_id', $employerId)
            ->with('job', 'candidate')
            ->get();

        $userApplications = $applications->map(function ($application) {
            return [
                'id' => $application->id,
                'candidate_name' => $application->candidate->name,
                'candidate_id' => $application->candidate->id,
                'job_title' => $application->job->title,
                'candidate_email' => $application->candidate->email,
                'date_of_application' => $application->created_at->toDateString(),
                'status' => $application->status,
            ];
        });
        return Inertia::render('Applications/show', ['userApplications' => $userApplications]);
    }

    public function showAcceptedJobs()
{
    $userId = Auth::id();
    
    $acceptedApplications = Application::where('user_id', $userId)
        ->where('status', 'Accepted')
        ->with('job')
        ->get();

    $acceptedJobs = $acceptedApplications->map(function ($application) {
        return [
            'job_id' => $application->job->id,
            'job_title' => $application->job->title,
            'job_description' => $application->job->desc,
            'application_id' => $application->id
        ];
    });

    return Inertia::render('Applications/news', ['acceptedJobs' => $acceptedJobs]);
}

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:applications,id',
            'status' => 'required|in:Accepted,Rejected,Cancelled',
        ]);
   
        $application = Application::findOrFail($request->id);
        $application->status = $request->status;
        $application->save();
    
    }
    
    public function showAppliedJobs()
{
    $userId = Auth::id();
        $userApplications = Application::where('user_id', $userId)
        ->with('job')
        ->get();

    $appliedJobs = $userApplications->map(function ($application) {
        return [
            'job_id' => $application->job->id,
            'job_title' => $application->job->title,
            'job_description' => $application->job->desc,
            'application_id' => $application->id,
            'application_status' => $application->status
        ];
    });

    return Inertia::render('Applications/applied', ['appliedJobs' => $appliedJobs]);
}

public function showRejectedJobs()
{
    $userId = Auth::id();
    
    $rejectedApplications = Application::where('user_id', $userId)
        ->where('status', 'Rejected')
        ->with('job')
        ->get();

    $rejectedJobs = $rejectedApplications->map(function ($application) {
        return [
            'job_id' => $application->job->id,
            'job_title' => $application->job->title,
            'job_description' => $application->job->desc,
            'application_id' => $application->id
        ];
    });

    return Inertia::render('Applications/badnews', ['rejectedJobs' => $rejectedJobs]);
}

public function showCandidateDetails($id)
    {
        $candidate = User::findOrFail($id);

        return Inertia::render('Applications/candidate', ['candidate' => $candidate]);
    }

}

