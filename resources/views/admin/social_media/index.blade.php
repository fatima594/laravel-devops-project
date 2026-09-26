@extends('admin.dashboard.master')

@section('title', 'Social Media')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Social Media</h2>
    <a href="{{ route('admin.social-media.create') }}" class="btn btn-primary">Add Social Media</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Instagram</th>
            <th>LinkedIn</th>
            <th>Facebook</th>
            <th>GitHub</th>
            <th>Twitter</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($socialMedias as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                @if($item->instagram)
                    <a href="{{ $item->instagram }}" target="_blank">{{ $item->instagram }}</a>
                @endif
            </td>
            <td>
                @if($item->linkedin)
                    <a href="{{ $item->linkedin }}" target="_blank">{{ $item->linkedin }}</a>
                @endif
            </td>
            <td>
                @if($item->facebook)
                    <a href="{{ $item->facebook }}" target="_blank">{{ $item->facebook }}</a>
                @endif
            </td>
            <td>
                @if($item->github)
                    <a href="{{ $item->github }}" target="_blank">{{ $item->github }}</a>
                @endif
            </td>
            <td>
                @if($item->twitter)
                    <a href="{{ $item->twitter }}" target="_blank">{{ $item->twitter }}</a>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.social-media.show', $item) }}" class="btn btn-info btn-sm">Show</a>
                <a href="{{ route('admin.social-media.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.social-media.destroy', $item) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this record?');">
                        Delete
                    </button>
                </form>
            </td>
            
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No Social Media records found.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
