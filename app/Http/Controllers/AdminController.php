<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\JobPortal;
use Illuminate\Http\Request;
use App\Models\Application;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch pending job postings from the database
        $pendingJobPostings = jobportal::where('status', 'pending')->get();
        $AcceptedJobPostings = jobportal::where('status', 'accepted')->get();
        $RejectedJobPostings = jobportal::where('status', 'rejected')->get();

        // Render the admin panel view and pass pending job postings data to the Vue.js component
        return Inertia::render('admin/AdminPanel', ['pendingJobPostings' => $pendingJobPostings]);
    }
    

    public function manageJobPostings()
    {
        // Fetch pending job postings
        $pendingJobPostings = JobPortal::where('status', 'pending')->get();
        
        // Render the view to manage job postings
        return Inertia::render('admin/job-postings', ['pendingJobPostings' => $pendingJobPostings]);
    }
    public function manageAcceptedJobPostings()
    {
        // Fetch pending job postings
        $AcceptedJobPostings = jobportal::where('status', 'accepted')->get();
        
        // Render the view to manage job postings
        return Inertia::render('admin/accepted-job-postings', ['acceptedJobPostings' => $AcceptedJobPostings]);
    }
    public function manageRejectedJobPostings()
    {
        // Fetch pending job postings
        $RejectedJobPostings = jobportal::where('status', 'rejected')->get();
        
        // Render the view to manage job postings
        return Inertia::render('admin/rejected-job-postings', ['rejectedJobPostings' => $RejectedJobPostings]);
    }
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|exists:jobportals,id',
            'status' => 'required|in:accepted,rejected,cancelled', // Assuming these are the valid status values
        ]);

        // Find the job by its ID
        $job = JobPortal::findOrFail($request->id);

        // Update the status
        $job->status = $request->status;
        $job->save();

        // Redirect back to the page where job postings are managed
        return Redirect::route('admin.jobPostings');
    }
    public function dashboard()
{
    // Count the total number of users except admins
    $totalUsers = User::where('role', '!=', User::ROLE_ADMIN)->count();

    // Count the total number of job postings
    $totalJobs = JobPortal::count();

    // Render the admin dashboard view and pass the data
    return Inertia::render('admin/dashboard', [
        'totalUsers' => $totalUsers,
        'totalJobs' => $totalJobs,
    ]);
}

public function countJobPostingsByStatus()
{
    // Count the number of job postings by status
    $jobCounts = [
        'accepted' => JobPortal::where('status', 'accepted')->count(),
        'pending' => JobPortal::where('status', 'pending')->count(),
        'rejected' => JobPortal::where('status', 'rejected')->count(),
    ];

    // Return job counts as part of Inertia render
    return Inertia::render('admin/job-postings-dashboard', ['jobCounts' => $jobCounts]);
}


    public function countEmployers()
    {
        $employersCount = User::where('role', User::ROLE_EMPLOYER)->count();

        return $employersCount;
    }

    public function countCandidates()
    {
        $candidatesCount = User::where('role', User::ROLE_CANDIDATE)->count();

        return $candidatesCount;
    }

    public function getUserCounts()
    {
        // Count the number of employers
        $employersCount = User::where('role', User::ROLE_EMPLOYER)->count();
    
        // Count the number of candidates
        $candidatesCount = User::where('role', User::ROLE_CANDIDATE)->count();
    
        // Render the user counts using Inertia
        return Inertia::render('admin/user-counts', [
            'employersCount' => $employersCount,
            'candidatesCount' => $candidatesCount,
        ]);
    }
    public function getEmployeeJobStatistics()
    {
        // Retrieve employees along with their job statistics
        $employees = User::where('role', User::ROLE_EMPLOYER)
            ->withCount(['postedJobs as total_jobs',
                'postedJobs as accepted_jobs' => function ($query) {
                    $query->where('status', 'accepted');
                },
                'postedJobs as rejected_jobs' => function ($query) {
                    $query->where('status', 'rejected');
                },
                'postedJobs as pending_jobs' => function ($query) {
                    $query->where('status', 'pending');
                }])
            ->get();
    
        // Render the employee job statistics using Inertia
        return Inertia::render('admin/employee-job-statistics', [
            'employees' => $employees,
        ]);
    }
    public function getCandidateApplications()
{
    $candidates = User::where('role', User::ROLE_CANDIDATE)
        ->withCount(['applications as total_applications',
            'applications as accepted_applications' => function ($query) {
                $query->where('status', 'accepted');
            },
            'applications as rejected_applications' => function ($query) {
                $query->where('status', 'rejected');
            },
            'applications as pending_applications' => function ($query) {
                $query->where('status', 'pending');
            }])
        ->get();

    return Inertia::render('admin/candidate-applications', [
        'candidates' => $candidates,
    ]);
}

}
