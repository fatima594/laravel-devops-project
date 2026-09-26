@extends('admin.dashboard.master')

@section('title', 'About')

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center" class="mb-4"> About Us</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br>
        <br>
        <!-- Create New Blog Post Button -->
        <a href="{{ route('admin.about.create') }}" class="btn btn-primary mb-3">Create New About</a>
        <br>
        <br>
        <br>
        <br>
        <!-- Blog Posts Table -->
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Name</th>
                <th>Body</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($abouts as $about)
                <tr>
                    <td>{{ $about->id }}</td>
                    <td>{{ $about->title }}</td>
                    <td>{{ $about->name}}</td>

<td>{!! \Illuminate\Support\Str::words(strip_tags($about->body), 100, '...') !!}</td>


                        {{-- <td>
                            @if ($post->image && Storage::disk('public')->exists('posts/' . $post->image))
                                <picture>
                                    <source srcset="{{ Storage::url('posts/' . $post->image) }}" type="image/webp">
                                    <img src="{{ Storage::url('posts/' . str_replace('.webp', '.jpg', $post->image)) }}" alt="{{ $post->title }}" style="width:50px; height:50px;">
                                </picture>
                            @else
                                <span>No Image</span>
                            @endif
                        </td> --}}








                    <td>
                        @if ($about->image)
                           <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->name }} - {{ $about->title }}" style="width:50px; height:50px;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.about.show', $about->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No About available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
