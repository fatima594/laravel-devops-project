@extends('admin.dashboard.master-admin')

@section('title', 'Admin Register')

@section('content')
    <body style="background: #2b2b2b">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form method="POST" action="{{ route('admin.register') }}" style="width: 100%; max-width: 400px;">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>



            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
    </body>
@endsection
<script>
    document.querySelector('#registerForm').addEventListener('submit', function (e) {
        e.preventDefault(); // منع إعادة تحميل الصفحة

        const formData = new FormData(this);

        fetch('/admin/register', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('تم التسجيل بنجاح!');
                    window.location.href = '/admin/dashboard';
                } else {
                    console.error(data.errors);
                    alert('حدث خطأ أثناء التسجيل.');
                }
            })
            .catch(error => console.error('حدث خطأ:', error));
    });

</script>
