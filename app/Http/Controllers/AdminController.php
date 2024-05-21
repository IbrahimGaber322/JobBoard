<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\JobPortal;
use Illuminate\Http\Request;
use App\Models\Application;
use Inertia\Inertia;
use App\Notifications\NewJobAddedNotification;
use Illuminate\Support\Facades\Redirect;

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
        'status' => 'required|in:accepted,rejected,cancelled', 
    ]);

    // Find the job by its ID
    $job = JobPortal::findOrFail($request->id);

    // Update the status
    $job->status = $request->status;
    $job->save();

    // Return a JSON response indicating success
    return response()->json(['message' => 'Job posting updated successfully']);
}
public function dashboard()
{
    // Fetch necessary data
    $totalUsers = User::where('role', '!=', User::ROLE_ADMIN)->count();
    $totalJobs = JobPortal::count();
    $jobCounts = [
        'accepted' => JobPortal::where('status', 'accepted')->count(),
        'pending' => JobPortal::where('status', 'pending')->count(),
        'rejected' => JobPortal::where('status', 'rejected')->count(),
    ];
    $employersCount = $this->countEmployers();
    $candidatesCount = $this->countCandidates();

    // Render the view and pass the data
    return Inertia::render('admin/dashboard', [
        'totalUsers' => $totalUsers,
        'totalJobs' => $totalJobs,
        'jobCounts' => $jobCounts,
        'employersCount' => $employersCount,
        'candidatesCount' => $candidatesCount,
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
public function handleNewJobNotification()
{
    $admin = User::where('role', 'admin')->first();
    $admin->notify(new NewJobAddedNotification());
    
    // Optionally, you can store the notification in the database or perform any other action.
}
public function notifications()
{
    // Fetch notifications for the authenticated admin user
    $notifications = auth()->user()->notifications->map(function ($notification) {
        return $notification->data['message'];
    });

    // Return the notification messages
    return Inertia::render('admin/notifications', [
        'notifications' => $notifications,
    ]);

}
public function notificationsCount()
{
    // Get the authenticated admin user
    $admin = auth()->user();

    // Get the count of unread notifications for the admin user
    $unreadNotificationsCount = $admin->unreadNotifications()->count();

    // Return the count as a JSON response
    return response()->json(['count' => $unreadNotificationsCount]);
}

public function markNotificationAsRead($notificationId)
{
    $notification = DatabaseNotification::findOrFail($notificationId);

    // Mark the notification as read
    $notification->markAsRead();

    return response()->json(['message' => 'Notification marked as read successfully']);
}
public function showJobPosting($id)
{
    $job = JobPortal::findOrFail($id);
    $employer = User::findOrFail($job->emp_id); 

    $numApplications = Application::where('job_id', $job->id)->count();

    return Inertia::render('admin/JobDetail', [
        'job' => $job,
        'employer' => $employer,
        'numApplications' => $numApplications, // Pass the number of applications to the view
    ]);
}


}