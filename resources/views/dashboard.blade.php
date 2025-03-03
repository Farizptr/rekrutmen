@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
                <p class="mb-2">Welcome, {{ Auth::user()->name }}! You're logged in!</p>
                
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2">Your Profile Information:</h3>
                    <ul class="list-disc pl-5">
                        <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li><strong>Gender:</strong> {{ ucfirst(Auth::user()->gender) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 