@extends('admin.dashboard.master')

@section('title', $about->title)

@section('content')
    <div class="container mt-5">
        <h1>{{ $about->title }}</h1>
        <h2>{{ $about->name }}</h2>


        <!-- Display Image -->
        @if ($about->image)
        <img src="{{ asset($about->image) }}" alt="{{ $about->title }}" width="100">
        @else
            <span>No Image</span>
        @endif


        <!-- Display Description -->
        <div class="mt-3">
            <strong>Description:</strong>
            <p>{!! nl2br(e($about->body)) !!}</p>
        </div>




        <!-- Back to List Button -->
        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary mt-3">Back to about List</a>
    </div>
@endsection
