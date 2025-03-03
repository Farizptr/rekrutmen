<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

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
                <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>
                <p class="mb-4">Welcome, {{ Auth::user()->name }}! You're logged in as an <span class="font-semibold text-indigo-600">Administrator</span>.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <h3 class="font-bold text-lg text-blue-800 mb-2">Lowongan</h3>
                        <p class="text-blue-600">Manage job openings and positions</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.lowongan') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Manage</a>
                        </div>
                    </div>
                    
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h3 class="font-bold text-lg text-green-800 mb-2">Rekrutmen</h3>
                        <p class="text-green-600">Manage recruitment processes and applicants</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.rekrutmen') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Manage</a>
                        </div>
                    </div>
                    
                    <div class="bg-purple-100 p-4 rounded-lg shadow">
                        <h3 class="font-bold text-lg text-purple-800 mb-2">User Statistics</h3>
                        <p class="text-purple-600">View user registration and activity statistics</p>
                        <div class="mt-4 text-center">
                            <span class="text-2xl font-bold text-purple-800">{{ \App\Models\User::where('role', 'user')->count() }}</span>
                            <span class="text-purple-600">Users</span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Your Profile</h3>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="bg-indigo-500 text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="font-bold">{{ Auth::user()->name }}</div>
                                <div class="text-gray-600">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 