@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-light border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="display-6 fw-bold mb-2">Job Openings</h1>
                            <p class="lead mb-0">Discover your next career opportunity</p>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('user.lowongan') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Search jobs..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search me-1"></i> Search
                                    </button>
                                </div>
                            </form>
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

    <!-- Job Listings -->
    @if($jobs->count() > 0)
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            @if($job->image_path)
                                <img src="{{ asset('storage/' . $job->image_path) }}" class="card-img-top" alt="{{ $job->title }}" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <i class="bi bi-briefcase" style="font-size: 3rem; color: #4361ee;"></i>
                                </div>
                            @endif
                            
                            @if(in_array($job->id, $appliedJobs))
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Applied
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-1">{{ $job->title }}</h5>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-2">
                                    <i class="bi bi-building me-1"></i> {{ $job->department }}
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-geo-alt me-1"></i> {{ $job->location }}
                                </span>
                            </div>
                            <p class="card-text text-muted mb-4">{{ Str::limit($job->description, 120) }}</p>
                            
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i> {{ $job->created_at->diffForHumans() }}
                                </small>
                                
                                @if(in_array($job->id, $appliedJobs))
                                    <a href="{{ route('user.applications') }}" class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-eye me-1"></i> View Application
                                    </a>
                                @else
                                    <a href="{{ route('user.lowongan.show', $job) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-arrow-right me-1"></i> View Details
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5 text-center">
                <i class="bi bi-search" style="font-size: 3rem; color: #6c757d;"></i>
                <h3 class="mt-3 mb-2">No job openings found</h3>
                <p class="text-muted mb-4">We couldn't find any job openings matching your criteria.</p>
                <a href="{{ route('user.lowongan') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Clear Search
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 