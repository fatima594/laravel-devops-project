@extends('admin.dashboard.master')

@section('title', 'social-media')

@section('content')

<h2>Social Media Details</h2>

<ul>
  @if($socialMedia->instagram)
    <li>
      <strong>Instagram:</strong>
      <a href="{{ $socialMedia->instagram }}" target="_blank">
        {{ $socialMedia->instagram }}
      </a>
    </li>
  @endif

  @if($socialMedia->linkedin)
    <li>
      <strong>LinkedIn:</strong>
      <a href="{{ $socialMedia->linkedin }}" target="_blank">
        {{ $socialMedia->linkedin }}
      </a>
    </li>
  @endif

  @if($socialMedia->facebook)
    <li>
      <strong>Facebook:</strong>
      <a href="{{ $socialMedia->facebook }}" target="_blank">
        {{ $socialMedia->facebook }}
      </a>
    </li>
  @endif

  @if($socialMedia->github)
    <li>
      <strong>GitHub:</strong>
      <a href="{{ $socialMedia->github }}" target="_blank">
        {{ $socialMedia->github }}
      </a>
    </li>
  @endif

  @if($socialMedia->twitter)
    <li>
      <strong>Twitter:</strong>
      <a href="{{ $socialMedia->twitter }}" target="_blank">
        {{ $socialMedia->twitter }}
      </a>
    </li>
  @endif
</ul>

<a href="{{ route('admin.social-media.index') }}">← Back</a>


@endsection
