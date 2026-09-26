@extends('admin.dashboard.master')

@section('content')
    <h1>All Categories</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Create New Category</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>

                <td>{{ $category->name }}</td>
                <td>
                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width:50px; height:50px;" onerror="console.error('Image not found: {{ asset($category->image) }}')">
                    @else
                        <span>No Image</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
