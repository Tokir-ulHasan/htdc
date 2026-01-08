@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-green-500 text-white px-6 py-4">
        <h2 class="text-xl font-semibold">About Hazera-Taju Degree College</h2>
    </div>
    <div class="p-6">
        <p class="text-red-700 mb-4">This is the about page demonstrating the new layout structure with topbar, navbar, sidebar, and footer.</p>
        <p class="text-gray-700">Our college is dedicated to providing quality education and fostering academic excellence.</p>
        <div class="mt-6 p-4 bg-gray-50 rounded">
            <h3 class="font-medium text-gray-800 mb-2">About our layout:</h3>
            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                <li>Top bar displays college branding with animated text</li>
                <li>Navigation bar provides quick access to main sections</li>
                <li>Toggleable sidebar for additional navigation on mobile</li>
                <li>Responsive design works on all screen sizes</li>
                <li>Footer contains important links and contact information</li>
            </ul>
        </div>
    </div>
</div>
@endsection