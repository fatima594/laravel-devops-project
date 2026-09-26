@extends('admin.dashboard.master') <!-- تأكد من أن القالب الرئيسي يتماشى مع لوحة التحكم -->

@section('content')
    <div class="container">
        <h1 class="my-4"> List of subscribers</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Date Of Subscribers </th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->id }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>{{ $subscriber->created_at->format('Y-m-d') }}</td>
                    </tr
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
