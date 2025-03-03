@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.lowongan') }}">Job Openings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $job->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Job Details -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="card-title h3 fw-bold mb-0">{{ $job->title }}</h1>
                        @if($hasApplied)
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                <i class="bi bi-check-circle-fill me-1"></i> Applied
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-flex flex-wrap mb-4">
                        <div class="me-4 mb-2">
                            <span class="badge bg-light text-dark p-2">
                                <i class="bi bi-building me-1"></i> Department: {{ $job->department }}
                            </span>
                        </div>
                        <div class="me-4 mb-2">
                            <span class="badge bg-light text-dark p-2">
                                <i class="bi bi-geo-alt me-1"></i> Location: {{ $job->location }}
                            </span>
                        </div>
                        <div class="mb-2">
                            <span class="badge bg-light text-dark p-2">
                                <i class="bi bi-clock me-1"></i> Posted: {{ $job->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    
                    @if($job->image_path)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $job->image_path) }}" 
                                 alt="{{ $job->title }}" 
                                 class="img-fluid rounded" 
                                 style="max-height: 300px; width: 100%; object-fit: cover;">
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Job Description</h5>
                        <div class="job-description">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('user.lowongan') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back to Jobs
                        </a>
                        
                        @if(!$hasApplied)
                            <a href="#apply-section" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i> Apply Now
                            </a>
                        @else
                            <a href="{{ route('user.applications') }}" class="btn btn-success">
                                <i class="bi bi-eye me-1"></i> View My Application
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Application Form or Status -->
        <div class="col-lg-4">
            @if(!$hasApplied)
                <div class="card border-0 shadow-sm" id="apply-section">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-send-check me-2"></i> Apply for this Position
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('user.lowongan.apply', $job) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="resume" class="form-label">Resume (PDF)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-file-earmark-pdf"></i></span>
                                    <input type="file" class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume" accept=".pdf" required>
                                    @error('resume')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message ?? 'Please upload a valid resume file.' }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Upload your resume in PDF format (max 2MB)</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cover_letter" class="form-label">Cover Letter</label>
                                <textarea class="form-control @error('cover_letter') is-invalid @enderror" id="cover_letter" name="cover_letter" rows="5" placeholder="Explain why you're a good fit for this position..." required>{{ old('cover_letter') }}</textarea>
                                @error('cover_letter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message ?? 'Please provide a cover letter.' }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-1"></i> Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-check-circle-fill me-2"></i> Application Status
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 2rem;"></i>
                            </div>
                            <h5>You've already applied for this position</h5>
                            @if(isset($application) && $application)
                                <p class="text-muted">Application submitted on {{ $application->created_at->format('M d, Y') }}</p>
                            @else
                                <p class="text-muted">Application submitted</p>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Current Status:</h6>
                            <div class="p-3 rounded bg-light">
                                @if(isset($application) && $application && $application->status == 'pending')
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-warning text-dark me-2">
                                            <i class="bi bi-hourglass-split"></i>
                                        </span>
                                        <span>Your application is pending review</span>
                                    </div>
                                @elseif(isset($application) && $application && $application->status == 'shortlisted')
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info me-2">
                                            <i class="bi bi-list-check"></i>
                                        </span>
                                        <span>You've been shortlisted for this position</span>
                                    </div>
                                @elseif(isset($application) && $application && $application->status == 'interview')
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary me-2">
                                            <i class="bi bi-calendar-event"></i>
                                        </span>
                                        <span>You've been selected for an interview</span>
                                    </div>
                                @elseif(isset($application) && $application && $application->status == 'accepted')
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success me-2">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </span>
                                        <span>Congratulations! Your application has been accepted</span>
                                    </div>
                                @elseif(isset($application) && $application && $application->status == 'rejected')
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-danger me-2">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </span>
                                        <span>We're sorry, your application was not selected</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-secondary me-2">
                                            <i class="bi bi-question-circle"></i>
                                        </span>
                                        <span>{{ isset($application) && $application ? ucfirst($application->status) : 'Pending' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('user.applications') }}" class="btn btn-primary">
                                <i class="bi bi-list-ul me-1"></i> View All Applications
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Similar Jobs -->
            @if(isset($similarJobs) && $similarJobs->count() > 0)
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-briefcase me-2 text-primary"></i> Similar Positions
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($similarJobs as $similarJob)
                                <li class="list-group-item p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $similarJob->title }}</h6>
                                            <small class="text-muted">
                                                <i class="bi bi-building me-1"></i> {{ $similarJob->department }}
                                            </small>
                                        </div>
                                        <a href="{{ route('user.lowongan.show', $similarJob) }}" class="btn btn-sm btn-outline-primary">
                                            View
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 