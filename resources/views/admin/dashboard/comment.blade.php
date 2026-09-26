@extends('admin.dashboard.master')

@section('content')
    <div class="container">
        <h1 class="my-4">عدد التعليقات: {{ $commentsCount }}</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>الاسم</th>
                    <th>التعليق</th>
                    <th>تاريخ الإنشاء</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
