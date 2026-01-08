@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-center mb-8 text-green-800">Student Application Form</h1>
    <student-multi-step-form :initial-pincode="'{{ request()->pincode ?? '' }}'"></student-multi-step-form>
</div>
@endsection


