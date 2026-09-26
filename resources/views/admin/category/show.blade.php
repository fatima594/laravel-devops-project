@extends('admin.dashboard.master')

@section('content')
    <h1>Category Details</h1>
    <p><strong>Name:</strong> {{ $category->name }}</p>
   <!-- Display Image -->
   @if ($post->image)
   <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="100">
   @else
       <span>No Image</span>
   @endif

    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection
