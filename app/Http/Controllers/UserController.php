<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user();
        $applications = $user->jobApplications()->with('job')->latest()->take(5)->get();
        $activeJobs = Job::where('status', 'active')->count();
        
        return view('user.dashboard', compact('user', 'applications', 'activeJobs'));
    }
    
    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    
    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender' => 'required|in:male,female',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        // Check current password if user is trying to change password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Show the job listings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lowongan()
    {
        $jobs = Job::where('status', 'active')->latest()->paginate(10);
        $user = Auth::user();
        $appliedJobs = $user->jobApplications()->pluck('job_id')->toArray();
        
        return view('user.lowongan', compact('jobs', 'appliedJobs'));
    }
    
    /**
     * Show a specific job.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showJob(Job $job)
    {
        $user = Auth::user();
        $hasApplied = $user->jobApplications()->where('job_id', $job->id)->exists();
        $application = $hasApplied ? $user->jobApplications()->where('job_id', $job->id)->first() : null;
        
        // Get similar jobs from the same department, excluding the current job
        $similarJobs = Job::where('department', $job->department)
                        ->where('id', '!=', $job->id)
                        ->where('status', 'active')
                        ->take(3)
                        ->get();
        
        return view('user.jobs.show', compact('job', 'hasApplied', 'application', 'similarJobs'));
    }
    
    /**
     * Apply for a job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function applyJob(Request $request, Job $job)
    {
        $user = Auth::user();
        
        // Check if user has already applied
        if ($user->jobApplications()->where('job_id', $job->id)->exists()) {
            return redirect()->route('user.lowongan.show', $job)->with('error', 'You have already applied for this job.');
        }
        
        $request->validate([
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        $resumePath = $request->file('resume')->store('resumes', 'public');
        
        $application = new JobApplication([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'status' => 'pending',
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter,
        ]);
        
        $application->save();
        
        return redirect()->route('user.applications')->with('success', 'Job application submitted successfully!');
    }
    
    /**
     * Show the user's job applications.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applications()
    {
        $user = Auth::user();
        $applications = $user->jobApplications()->with('job')->latest()->paginate(10);
        
        return view('user.applications', compact('applications'));
    }
}
