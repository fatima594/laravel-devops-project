@extends('admin.dashboard.master')

@section('content')

    <!-- عرض رسائل الأخطاء إن وجدت -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- عرض رسالة النجاح إن وجدت -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Edit Category</h1>
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($category->image)
            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="100">
            @else
                <span>No Image</span>
            @endif
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection
