<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the lowongan management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lowongan()
    {
        $jobs = Job::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lowongan', compact('jobs'));
    }

    /**
     * Show the rekrutmen management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rekrutmen()
    {
        // Get all job applications with their related user and job information
        $applications = JobApplication::with(['user', 'job'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        // Count applications by status
        $totalApplications = JobApplication::count();
        $shortlistedCount = JobApplication::where('status', 'shortlisted')->count();
        $interviewCount = JobApplication::where('status', 'interview')->count();
        $hiredCount = JobApplication::where('status', 'hired')->count();
        
        return view('admin.rekrutmen', compact(
            'applications', 
            'totalApplications', 
            'shortlistedCount', 
            'interviewCount', 
            'hiredCount'
        ));
    }
    
    /**
     * Show the form for creating a new job.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createJob()
    {
        return view('admin.jobs.create');
    }
    
    /**
     * Store a newly created job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->department = $request->department;
        $job->location = $request->location;
        $job->status = 'active';
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('job-images', 'public');
            $job->image_path = $imagePath;
        }
        
        $job->save();
        
        return redirect()->route('admin.lowongan')->with('success', 'Job created successfully!');
    }
    
    /**
     * Show the form for editing the specified job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editJob(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }
    
    /**
     * Update the specified job in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function updateJob(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $job->title = $request->title;
        $job->description = $request->description;
        $job->department = $request->department;
        $job->location = $request->location;
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($job->image_path) {
                Storage::disk('public')->delete($job->image_path);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('job-images', 'public');
            $job->image_path = $imagePath;
        }
        
        $job->save();
        
        return redirect()->route('admin.lowongan')->with('success', 'Job updated successfully!');
    }
    
    /**
     * Remove the specified job from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function deleteJob(Job $job)
    {
        // Delete image if exists
        if ($job->image_path) {
            Storage::disk('public')->delete($job->image_path);
        }
        
        $job->delete();
        
        return redirect()->route('admin.lowongan')->with('success', 'Job deleted successfully!');
    }
    
    /**
     * Toggle the status of the specified job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function toggleJobStatus(Job $job)
    {
        $job->status = $job->status === 'active' ? 'inactive' : 'active';
        $job->save();
        
        $statusText = $job->status === 'active' ? 'activated' : 'deactivated';
        
        return redirect()->route('admin.lowongan')->with('success', "Job {$statusText} successfully!");
    }
    
    /**
     * Show the details of a specific job application.
     *
     * @param  \App\Models\JobApplication  $application
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applicationDetails(JobApplication $application)
    {
        // Load the related user and job data
        $application->load(['user', 'job']);
        
        return view('admin.applications.details', compact('application'));
    }
    
    /**
     * Update the status of a job application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobApplication  $application
     * @return \Illuminate\Http\Response
     */
    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,shortlisted,interview,hired,rejected',
        ]);
        
        $application->status = $request->status;
        $application->save();
        
        return redirect()->route('admin.application.details', $application)
            ->with('success', 'Application status updated successfully!');
    }
}
