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

        // Count the number of accepted job postings
        $acceptedJobPostings = JobPortal::where('status', 'accepted')->count();

        // Count the number of pending job postings
        $pendingJobPostings = JobPortal::where('status', 'pending')->count();

        // Count the number of rejected job postings
        $rejectedJobPostings = JobPortal::where('status', 'rejected')->count();

        // Render the admin dashboard view and pass the data
        return Inertia::render('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'acceptedJobPostings' => $acceptedJobPostings,
            'pendingJobPostings' => $pendingJobPostings,
            'rejectedJobPostings' => $rejectedJobPostings,
        ]);
    }
}
