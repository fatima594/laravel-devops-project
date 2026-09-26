@extends('admin.dashboard.master')

@section('title', 'social-media')

@section('content')

<form action="{{ route('admin.social-media.store') }}" method="POST">
  @csrf

  <input type="url" name="instagram" placeholder="Instagram">
  <input type="url" name="linkedin" placeholder="LinkedIn">
  <input type="url" name="facebook" placeholder="Facebook">
  <input type="url" name="github" placeholder="GitHub">
  <input type="url" name="twitter" placeholder="Twitter">

  <button type="submit">Save</button>
</form>


@endsection
