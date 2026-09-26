@extends('admin.dashboard.master')

@section('title', 'Posts')

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center" class="mb-4"> Posts</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br>
        <br>
        <!-- Create New Blog Post Button -->
        <a href="{{ route('admin.post.create') }}" class="btn btn-primary mb-3">Create New Post</a>
        <br>
        <br>
        <br>
        <br>
        <!-- Blog Posts Table -->
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>category</th>
                <th>body</th>
                <th>image-Alt</th>
                <th>Meta-Description</th>
                <th>Meta-Title</th>
                <th>image</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name ?? 'No Category' }}</td>

                    <td>{!! \Illuminate\Support\Str::words(strip_tags($post->body), 100, '...') !!}</td>
                    <td>{{ $post->image_alt }}</td>
                    <td>{{ $post->meta_description }}</td>
                    <td>{{ $post->meta_title }}</td>


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
                        @if ($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->image_alt }}" style="width:50px !important; height:50px !important;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.post.show', $post->slug) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No blog posts available</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
