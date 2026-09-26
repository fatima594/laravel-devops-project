@extends('admin.dashboard.master')

@section('title', $post->title)

@section('content')
    <div class="container mt-5">
        <h1>{{ $post->title }}</h1>

        <!-- Display Image -->
        @if ($post->image)
        <img src="{{ asset($post->image) }}" alt="{{ $post->alt }}" width="100">
        @else
            <span>No Image</span>
        @endif

        <!-- Display Slug -->
        <div class="mt-3">
            <strong>Slug:</strong> {{ $post->slug }}
        </div>

        <div class="mt-3">
            <strong>Alt:</strong> {{ $post->alt }}
        </div>

        <!-- Display Category -->
        <div class="mt-3">
            <strong>Category:</strong> {{ $post->category->name ?? 'No Category' }}
        </div>


        <!-- Display Description -->
        <div class="mt-3">
            <strong>Description:</strong>
            <p>{!! nl2br(e($post->body)) !!}</p>
        </div>

        <!-- Display Video -->
        <div class="mt-3">
            <strong>Video:</strong>
            @if ($post->video_url)
                <iframe width="560" height="315" src="{{ $post->video_url }}" frameborder="0" allowfullscreen></iframe>
            @else
                <span>No Video</span>
            @endif
        </div>



        <!-- Back to List Button -->
        <a href="{{ route('admin.post.index') }}" class="btn btn-secondary mt-3">Back to post List</a>
    </div>
@endsection
