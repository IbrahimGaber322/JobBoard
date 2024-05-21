<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsCandidate;
use App\Http\Middleware\EnsureIsEmployer;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/', [JobController::class, 'Jobs'])->name('home');
Route::get('/', [JobController::class, 'Jobs'])->name('home');
Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');




//Routes for admins only
Route::middleware([EnsureIsAdmin::class])->group(function () {
    // Define routes for admin panel
    Route::post('/admin/notifications/{notificationId}/mark-as-read', 'AdminController@markNotificationAsRead');
    Route::get('/admin/notifications/count', [AdminController::class, 'notificationsCount']);
    Route::get('/admin/notifications', [AdminController::class, 'notifications'])->name('admin.notifications')->middleware('auth');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/job-postings', [AdminController::class, 'manageJobPostings'])->name('admin.jobPostings');
    Route::get('/admin/accepted-job-postings', [AdminController::class, 'manageAcceptedJobPostings'])->name('admin.acceptedJobPostings');
    Route::get('/admin/rejected-job-postings', [AdminController::class, 'manageRejectedJobPostings'])->name('admin.rejectedJobPostings');
    Route::post('/admin/job-postings/update', [AdminController::class, 'update'])->name('admin.jobPostings.update');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/employee-job-statistics', [AdminController::class, 'getEmployeeJobStatistics'])
        ->name('admin.employeeJobStatistics');
    Route::get('/admin/candidate-applications', [AdminController::class, 'getCandidateApplications'])->name('admin.candidateApplications');
    Route::get('/admin/user-counts', [AdminController::class, 'getUserCounts'])->name('admin.userCounts');
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/admin/job-postings/{id}', [AdminController::class, 'showJobPosting'])->name('admin.jobPosting');

});

//Routes for employers only
Route::middleware([EnsureIsEmployer::class])->group(function () {
    Route::get('/profile/employer/show', [EmployerProfileController::class, 'show'])->name('employer.profile.edit');
    Route::get('/profile/employer/edit', [EmployerProfileController::class, 'edit'])->name('employer.profile.edit-employer');
    Route::post('/profile/employer', [EmployerProfileController::class, 'update'])->name('employer.profile.update');
    Route::delete('/profile/employer', [EmployerProfileController::class, 'delete'])->name('employer.profile.delete');
    Route::get('/myJobs/create', [JobController::class, 'create'])->name('job.create');
    Route::get('/employer/jobs', [JobController::class, 'employerJobs'])->name('job.employerJobs');
    //Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/job', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/job/{id}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::post('/jobUpdate/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('job.delete');
    Route::get('/applications', [ApplicationController::class, 'show'])->name('application.show');
    Route::post('/my-applications', [ApplicationController::class, 'update'])->name('app-accept.update');
    Route::get('/candidate/{id}', [ApplicationController::class, 'showCandidateDetails'])->name('candidate.details');
});

//Routes for only candidates only
Route::middleware([EnsureIsCandidate::class])->group(function () {
    Route::get('/demo', [DemoController::class, 'index'])->name('demo');
    Route::get('/profile/candidate/', [ProfileController::class, 'edit'])->name('candidate.profile.edit');
    Route::post('/profile/candidate/', [ProfileController::class, 'update'])->name('candidate.profile.update');
    Route::delete('/profile/candidate/', [ProfileController::class, 'destroy'])->name('candidate.profile.destroy');
    // Route::get('/job', [JobController::class, 'index'])->name('job.index');
    // Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');
    Route::post('/job/{id}', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/applied-jobs', [ApplicationController::class, 'showAppliedJobs'])->name('application.showapplied');
    Route::post('/applications', [ApplicationController::class, 'update'])->name('app.update');
    Route::get('/news', [ApplicationController::class, 'showAcceptedJobs'])->name('app.news');
    Route::get('/badnews', [ApplicationController::class, 'showRejectedJobs'])->name('app.badnews');

});



require __DIR__ . '/auth.php';
