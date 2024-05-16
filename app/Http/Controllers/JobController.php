<?php

namespace App\Http\Controllers;
use App\Services\CloudinaryService;
use App\Models\jobportal;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Notifications\NewJobAddedNotification;

use App\Models\User;

class JobController extends Controller
{

    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

    public function create()
    {
        $userId = auth()->id();
        return Inertia::render('Job/Create');
    }


    public function store(Request $request, CloudinaryService $cloudinaryService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            // 'experience_level' => 'string',
            // 'responsibilities' => 'string',
            // 'skills' => 'string',
            // 'salary_range' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'], 
            'salary_range' => ['nullable', 'regex:/^(?!(?:-))[a-zA-Z0-9.]*$/'],
            // 'date' => 'date',
            // 'category' => 'string',
            // 'location' => 'string',
            'work_type' => 'required|string|in:hybrid,remote,onsite',
            // 'status' => 'string',
            // 'emp_id' => 'exists:users,id',
            // 'no_of_candidates' => 'integer',
            // 'deadline' => 'date',
            'deadline' => 'required|date|after_or_equal:today',
            'company_name' => 'required|string',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      
        ]);
  // Inside the store method
        // $employerName = auth()->user()->name; // Assuming the employer's name is stored in the 'name' field
        // $admin = User::where('role', 'admin')->first();
        // $admin->notify(new NewJobAddedNotification($employerName));
        $userId = auth()->id(); 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadResult = $cloudinaryService->uploadImage($image);
            $imageUrl = $uploadResult['secure_url'];
        } else {
            $imageUrl = null;
        }

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
            'emp_id' => $userId,
            // 'no_of_candidates' => $request->no_of_candidates,
            'deadline' => $request->deadline,
            'company_name' => $request->company_name,
            'image' => $imageUrl
            
        ]);

        return redirect()->route('job.create')->with('success', 'Job created successfully.');
    }

    public function employerJobs(Request $request)
    {
        $userId = $request->user()->id;
        $jobs = JobPortal::with('employer')
        ->where('emp_id', $userId)
        ->paginate(9)->withQueryString();

        if (auth()->check()) {
            $user = auth()->user();
            $userRole = $user->role;
            $userId = $user->id;
    
            $isEmployer = $userRole === 'employer';
            $isOwner = false;
    
            foreach ($jobs as $job) {
                if ($userRole === 'employer' && $job->employer->id === $userId) {
                    $isOwner = true;
                    break;
                }
            }
        } else {
            $userRole = null;
            $isEmployer = false;
            $userId = null; 
            $isOwner = false;
        }
        return Inertia::render('Job/Jobs',  ['jobs' => $jobs, 'userRole' => $userRole, 'isEmployer' => $isEmployer, 'isOwner' => $isOwner]);
    }

    public function Jobs(Request $request)
    {
        $jobs = jobportal::with('employer')
        ->where('status', 'accepted')
        ->paginate(9)->withQueryString();

        return Inertia::render('Job/Jobs', ['jobs' => $jobs]);
    }


    public function show($id)
    {
        $job = jobportal::with('employer')->findOrFail($id);


        if (auth()->check()) {
            $user = auth()->user();
            $userRole = $user->role;
            $userId = $user->id;

            $isEmployer = $userRole === 'employer' && $job->emp_id === $userId;
            $isOwner = $userId === $job->emp_id;
            $hasApplied = Application::where('job_id', $id)
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'Accepted', 'Rejected'])
            ->exists();
            $appId = null;

            if ($hasApplied) {
                $appId = Application::where('job_id', $id)
                    ->where('user_id', $userId)
                    ->pluck('id')
                    ->first();
            } else {
                $appId = null;
            }

        } else {
            $userRole = null;
            $isEmployer = false;
            $userId = null;
            $isOwner = null;
            $hasApplied = false;
            $appId = null;
        }

        return Inertia::render('Job/ShowJob', ['job' => $job, 'userRole' => $userRole, 'isEmployer' => $isEmployer, 'hasApplied' => $hasApplied, 'isOwner' => $isOwner, 'appId' => $appId]);
    }


    public function edit($id)
    {
        $user = auth()->user();
        $job = jobportal::findOrFail($id);
        $isOwner = $job->emp_id === $user->id;
        return Inertia::render('Job/EditJob', ['job' => $job, $isOwner]);
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
            // 'experience_level' => 'string',
            // 'responsibilities' => 'string',
            // 'skills' => 'string',
            // 'salary_range' => 'string',
            'salary_range' => ['nullable', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            // 'date' => 'date',
            // 'category' => 'string',
            // 'location' => 'string',
            'work_type' => 'required|string|in:hybrid,remote,onsite',
            // 'status' => 'string',
            // 'emp_id' => 'exists:users,id',
            // 'deadline' => 'date',
            'deadline' => 'required|date|after_or_equal:today',
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