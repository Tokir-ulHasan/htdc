@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- By default (mobile-first), the sections will stack.
         On medium screens (md) and up, they will display side-by-side. -->
    <div class="flex flex-col md:flex-row gap-6">
      <!-- Section 1: Slider 
           Mobile: Full width (w-full).
           Medium (md) and up: 60% width (w-3/5). -->
      <section class="w-full md:w-3/5">
        <slider :images='@json([asset("images/banner1.png"), asset("images/banner2.png"), asset("images/banner3.png")])'></slider>
      </section>

      <!-- Section 2: Welcome 
           Mobile: Full width (w-full).
           Medium (md) and up: 40% width (w-2/5). -->
      <section class="w-full md:w-2/5 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold">Welcome sdfg to Hazera-Taju Degree College</h1>
        <div class="mt-2 text-slate-700">This is a starter site scaffolded per provided specifications. Use the sidebar to navigate pages.</div>
      </section>
    </div>
</div>
@endsection


