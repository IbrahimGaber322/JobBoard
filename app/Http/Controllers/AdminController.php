<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPortal;
use App\Models\Application;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch pending job postings from the database
        $pendingJobPostings = jobportal::where('status', 'pending')->get();
        
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

    public function approveJobPosting(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_portals,id',
        ]);

        // Find the job posting by ID
        $jobPosting = JobPortal::findOrFail($request->job_id);

        // Update the status to approved
        $jobPosting->status = 'accepted';
        $jobPosting->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Job posting approved successfully!');
    }

    public function rejectJobPosting(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_portals,id',
        ]);

        // Find the job posting by ID
        $jobPosting = JobPortal::findOrFail($request->job_id);

        // Update the status to rejected
        $jobPosting->status = 'rejected';
        $jobPosting->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Job posting rejected successfully!');
    }
    public function dashboard()
    {
        // Render the admin dashboard view
        return Inertia::render('admin/AdminDashboard');
    }
}
