@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-light border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">My Applications</h1>
                            <p class="lead mb-0">Track the status of your job applications</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('user.lowongan') }}" class="btn btn-primary">
                                <i class="bi bi-briefcase me-1"></i> Browse Jobs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Applications List -->
    @if($applications->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Job Title</th>
                                <th scope="col">Department</th>
                                <th scope="col">Applied Date</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            @if($application->job->image_path)
                                                <div class="me-3">
                                                    <img src="{{ asset('storage/' . $application->job->image_path) }}" 
                                                         alt="{{ $application->job->title }}" 
                                                         class="rounded" 
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="me-3 bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-briefcase text-primary"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $application->job->title }}</h6>
                                                <small class="text-muted">{{ $application->job->location }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $application->job->department }}</td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($application->status == 'pending')
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-hourglass-split me-1"></i> Pending
                                            </span>
                                        @elseif($application->status == 'shortlisted')
                                            <span class="badge bg-info">
                                                <i class="bi bi-list-check me-1"></i> Shortlisted
                                            </span>
                                        @elseif($application->status == 'interview')
                                            <span class="badge bg-primary">
                                                <i class="bi bi-calendar-event me-1"></i> Interview
                                            </span>
                                        @elseif($application->status == 'accepted')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i> Accepted
                                            </span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle-fill me-1"></i> Rejected
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($application->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('user.lowongan.show', $application->job) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye me-1"></i> View Job
                                            </a>
                                            @if($application->resume_path)
                                                <a href="{{ asset('storage/' . $application->resume_path) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-file-earmark-text me-1"></i> Resume
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $applications->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5 text-center">
                <i class="bi bi-clipboard-x" style="font-size: 3rem; color: #6c757d;"></i>
                <h3 class="mt-3 mb-2">No applications found</h3>
                <p class="text-muted mb-4">You haven't applied to any jobs yet.</p>
                <a href="{{ route('user.lowongan') }}" class="btn btn-primary">
                    <i class="bi bi-briefcase me-1"></i> Browse Jobs
                </a>
            </div>
        </div>
    @endif

    <!-- Application Tips -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-3">
                <i class="bi bi-lightbulb-fill text-warning me-2"></i> Application Tips
            </h5>
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                <i class="bi bi-file-earmark-text text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Resume</h6>
                            <p class="text-muted small mb-0">Keep your resume updated and tailored for each position</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                <i class="bi bi-envelope-paper text-success"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Cover Letter</h6>
                            <p class="text-muted small mb-0">Write a personalized cover letter highlighting relevant skills</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex">
                        <div class="me-3">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                <i class="bi bi-bell text-info"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">Stay Updated</h6>
                            <p class="text-muted small mb-0">Check this page regularly for application status updates</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 