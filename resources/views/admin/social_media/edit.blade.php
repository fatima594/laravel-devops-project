@extends('admin.dashboard.master')

@section('title', 'social-media')

@section('content')

<form action="{{ route('admin.social-media.update', $socialMedia) }}" method="POST">
  @csrf
  @method('PUT')

  <input type="url" name="instagram" value="{{ $socialMedia->instagram }}">
  <input type="url" name="linkedin" value="{{ $socialMedia->linkedin }}">
  <input type="url" name="facebook" value="{{ $socialMedia->facebook }}">
  <input type="url" name="github" value="{{ $socialMedia->github }}">
  <input type="url" name="twitter" value="{{ $socialMedia->twitter }}">

  <button type="submit">Update</button>
</form>


@endsection
