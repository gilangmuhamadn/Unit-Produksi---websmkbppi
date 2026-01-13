@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Staff Pengajar</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($staffPengajar as $staff)
        <div class="card">
            <img src="{{ asset('storage/' . $staff->photo) }}" alt="Foto Pengajar">
            <h2>{{ $staff->name }}</h2>
            <p class="text-sm text-gray-600">{{ $staff->position }}</p>
            <p>{{ $staff->department }}</p>
            <blockquote>{{ $staff->quote }}</blockquote>
        </div>
        @endforeach
    </div>
</div>
@endsection

