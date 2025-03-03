@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="display-6 fw-bold mb-2">Welcome back, {{ $user->name }}!</h2>
                            <p class="lead mb-0">Find your dream job or track your applications all in one place.</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ route('user.lowongan') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-search me-2"></i> Browse Jobs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card h-100 border-0 bg-light">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-briefcase" style="font-size: 3rem; color: #4361ee;"></i>
                    </div>
                    <h3 class="display-5 fw-bold text-primary">{{ $activeJobs }}</h3>
                    <p class="text-muted mb-3">Active Job Openings</p>
                    <a href="{{ route('user.lowongan') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-right me-1"></i> Browse Jobs
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4 mb-md-0">
            <div class="card h-100 border-0 bg-light">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #4361ee;"></i>
                    </div>
                    <h3 class="display-5 fw-bold text-primary">{{ $applications->count() }}</h3>
                    <p class="text-muted mb-3">Your Applications</p>
                    <a href="{{ route('user.applications') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-right me-1"></i> View Applications
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 bg-light">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-person" style="font-size: 3rem; color: #4361ee;"></i>
                    </div>
                    <h3 class="display-5 fw-bold text-primary">Profile</h3>
                    <p class="text-muted mb-3">Update Your Information</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-right me-1"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Applications -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clock-history me-2 text-primary"></i> Recent Applications
                    </h5>
                    <a href="{{ route('user.applications') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">{{ $application->job->title }}</div>
                                                <div class="small text-muted">{{ $application->job->department }}</div>
                                            </td>
                                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if($application->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($application->status == 'shortlisted')
                                                    <span class="badge bg-info">Shortlisted</span>
                                                @elseif($application->status == 'interview')
                                                    <span class="badge bg-primary">Interview</span>
                                                @elseif($application->status == 'accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @elseif($application->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($application->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('user.lowongan.show', $application->job) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i> You haven't applied to any jobs yet. 
                            <a href="{{ route('user.lowongan') }}" class="alert-link">Browse available job openings</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- User Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-badge me-2 text-primary"></i> Your Profile
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex justify-content-center align-items-center bg-primary rounded-circle text-white mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <h5 class="fw-bold">{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span><i class="bi bi-gender-ambiguous me-2"></i> Gender:</span>
                            <span class="fw-semibold">{{ ucfirst($user->gender) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span><i class="bi bi-person-badge me-2"></i> Role:</span>
                            <span class="fw-semibold">{{ ucfirst($user->role) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span><i class="bi bi-calendar-check me-2"></i> Joined:</span>
                            <span class="fw-semibold">{{ $user->created_at->format('M d, Y') }}</span>
                        </li>
                    </ul>
                    
                    <div class="d-grid mt-4">
                        <a href="{{ route('user.profile') }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square me-2"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 