@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Staff TU</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($staffTU as $staff)
        <div class="card">
            <img src="{{ asset('storage/' . $staff->photo) }}" alt="Foto Staff TU">
            <h2>{{ $staff->name }}</h2>
            <p>{{ $staff->department }}</p>
            <blockquote>{{ $staff->quote }}</blockquote>
        </div>
        @endforeach
    </div>
</div>
@endsection
