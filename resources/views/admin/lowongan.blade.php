<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Manage Lowongan</title>

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
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Manage Lowongan</h2>
                    <a href="{{ route('admin.lowongan.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Job
                    </a>
                </div>
                
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="mb-4">
                    <div class="flex items-center bg-gray-100 p-4 rounded-lg">
                        <input type="text" placeholder="Search jobs..." class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="ml-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Job Title</th>
                                <th class="py-3 px-6 text-left">Department</th>
                                <th class="py-3 px-6 text-center">Location</th>
                                <th class="py-3 px-6 text-center">Posted Date</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse ($jobs as $job)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        <div class="font-medium">{{ $job->title }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div>{{ $job->department }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div>{{ $job->location }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div>{{ $job->created_at->format('Y-m-d') }}</div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-{{ $job->status === 'active' ? 'green' : 'yellow' }}-200 text-{{ $job->status === 'active' ? 'green' : 'yellow' }}-700 py-1 px-3 rounded-full text-xs">{{ ucfirst($job->status) }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <!-- Toggle Status Button -->
                                            <form action="{{ route('admin.lowongan.toggle-status', $job) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="w-4 mr-3 transform hover:text-{{ $job->status === 'active' ? 'yellow' : 'green' }}-500 hover:scale-110 cursor-pointer" title="{{ $job->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.lowongan.edit', $job) }}" class="w-4 mr-3 transform hover:text-blue-500 hover:scale-110 cursor-pointer" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.lowongan.delete', $job) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 text-center text-gray-500">No jobs found. Create your first job!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>