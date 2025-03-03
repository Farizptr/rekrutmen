<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Application Details</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 min-h-screen p-4">
            <div class="text-white font-bold text-xl mb-6">Admin Panel</div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.lowongan') }}" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.lowongan') ? 'bg-gray-700' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                            Lowongan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.rekrutmen') }}" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700 {{ request()->routeIs('admin.rekrutmen') ? 'bg-gray-700' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Rekrutmen
                        </a>
                    </li>
                    <li class="mt-6 pt-6 border-t border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center text-white py-2 px-4 rounded hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm1 2h10v10H4V5zm4.293 2.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-2 2a1 1 0 01-1.414-1.414L9.586 10 8.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.rekrutmen') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Applications
                    </a>
                </div>
                
                <!-- Success Message -->
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif
                
                <!-- Application Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Application Details</h2>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.application.status', $application) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center space-x-2">
                                <select name="status" class="rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                    <option value="interview" {{ $application->status == 'interview' ? 'selected' : '' }}>Interview</option>
                                    <option value="hired" {{ $application->status == 'hired' ? 'selected' : '' }}>Hired</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Application Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Applicant Info -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Applicant Information</h3>
                        <div class="flex items-center mb-4">
                            <div class="mr-4">
                                <img class="w-16 h-16 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($application->user->name) }}&background=random" alt="{{ $application->user->name }}">
                            </div>
                            <div>
                                <h4 class="text-xl font-bold">{{ $application->user->name }}</h4>
                                <p class="text-gray-600">{{ $application->user->email }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Applied On:</span>
                                <span class="font-medium">{{ $application->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                @php
                                    $statusColors = [
                                        'pending' => 'blue',
                                        'shortlisted' => 'green',
                                        'interview' => 'yellow',
                                        'hired' => 'purple',
                                        'rejected' => 'red'
                                    ];
                                    $statusColor = $statusColors[$application->status] ?? 'gray';
                                @endphp
                                <span class="bg-{{ $statusColor }}-200 text-{{ $statusColor }}-700 py-1 px-3 rounded-full text-xs">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Job Info -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Job Information</h3>
                        <div class="space-y-3">
                            <div>
                                <h4 class="text-xl font-bold">{{ $application->job->title }}</h4>
                                <p class="text-gray-600">{{ $application->job->department }}</p>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $application->job->location }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <span>Posted: {{ $application->job->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-block bg-{{ $application->job->status === 'active' ? 'green' : 'red' }}-200 text-{{ $application->job->status === 'active' ? 'green' : 'red' }}-700 py-1 px-3 rounded-full text-xs">
                                    {{ ucfirst($application->job->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Application Details -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Application Details</h3>
                        <div class="space-y-4">
                            @if($application->resume_path)
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Resume</h4>
                                <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                                    </svg>
                                    Download Resume
                                </a>
                            </div>
                            @endif
                            
                            @if($application->cover_letter)
                            <div>
                                <h4 class="font-medium text-gray-700 mb-2">Cover Letter</h4>
                                <div class="bg-white p-4 rounded border border-gray-200 text-gray-700">
                                    {!! nl2br(e($application->cover_letter)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Notes and Timeline Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Notes Section (Placeholder for future functionality) -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Interview Notes</h3>
                        <p class="text-gray-500 italic">No interview notes have been added yet.</p>
                        
                        <!-- This would be a form for adding notes in a future implementation -->
                        <div class="mt-4">
                            <textarea disabled class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" rows="3" placeholder="Add interview notes..."></textarea>
                            <button disabled class="mt-2 bg-gray-400 text-white px-4 py-2 rounded">
                                Save Notes
                            </button>
                        </div>
                    </div>
                    
                    <!-- Application Timeline (Placeholder for future functionality) -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-gray-800 border-b pb-2">Application Timeline</h3>
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <div class="w-0.5 h-full bg-blue-300"></div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium">Application Submitted</h4>
                                    <p class="text-xs text-gray-500">{{ $application->created_at->format('M d, Y - h:i A') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-400">Current Status: {{ ucfirst($application->status) }}</h4>
                                    <p class="text-xs text-gray-500">Last updated: {{ $application->updated_at->format('M d, Y - h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 