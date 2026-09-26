
@extends('admin.dashboard.master')

@section('title', 'Create About Post')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1>Create About Post</h1>
        <form action="{{ route('admin.about.store') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label> Body </label>
                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="body"></textarea>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary" id="submitButton">Create</button>
        </form>
    </div>
   <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content'), {
            language: 'en',  // تفعيل اللغة العربية
            directionality: 'rtl',  // تفعيل الكتابة من اليمين لليسار
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'blockQuote',
                'undo',
                'redo',
                'imageUpload',  // إضافة أداة رفع الصور
            ],
            image: {
                toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side'],  // خيارات تنسيق الصورة
            },
            heading: {
                options: [
                    { model: 'paragraph', view: 'p', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }

                ]
            }
        }).catch(error => {
            console.error(error);
        });



        document.getElementById("createPostForm").addEventListener("submit", function(event) {
            event.preventDefault(); // منع الإرسال التقليدي للنموذج

            // التحقق من صحة البيانات قبل الإرسال
            function validateForm() {
                const title = document.getElementById('title').value;
                const body = document.getElementById('content').value;
                const category = document.getElementById('category_id').value;
                const image = document.getElementById('image').files.length;

                if (!title || !body || !category || !image) {
                    alert("Please fill all the required fields.");
                    return false; // منع الإرسال
                }
                return true; // السماح بالإرسال
            }

            // التأكد من صحة البيانات
            if (!validateForm()) return;

            // استخراج البيانات من النموذج
            const formData = new FormData();
            formData.append("title", document.getElementById("title").value);
            formData.append("body", document.getElementById("content").value);
            formData.append("video_url", document.getElementById("video_url").value);
            formData.append("category_id", document.getElementById("category_id").value);
            formData.append("image", document.getElementById("image").files[0]);

            // إرسال البيانات إلى الـ API باستخدام Fetch
            fetch("{{ route('admin.posts.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
                .then(response => {
                    console.log('Response status:', response.status); // طباعة حالة الاستجابة
                    return response.json(); // تحويل الاستجابة إلى JSON
                })
                .then(data => {
                    console.log('Response data:', data); // طباعة البيانات التي تم استلامها
                    if (data.success) {
                        alert(data.message); // عرض رسالة النجاح
                        window.location.href = "{{ route('admin.posts.index') }}"; // إعادة التوجيه بعد النجاح
                    } else {
                        alert("حدث خطأ في إرسال البيانات.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Something went wrong.");
                });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

@endsection





<!--

{{--@extends('admin.dashboard.master')--}}

{{--@section('title', 'Create Blog Post')--}}

{{--@section('content')--}}

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger" >--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if (session('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="container mt-5">--}}
{{--        <h1>Create Blog Post</h1>--}}
{{--        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <div class="mb-3">--}}
{{--                <label for="title" class="form-label">Title</label>--}}
{{--                <input type="text" id="title" name="title" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label> Body </label>--}}
{{--                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="body"></textarea>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="video_url" class="form-label">Video URL</label>--}}
{{--                <input type="text" id="video_url" name="video_url" class="form-control" placeholder="Enter the Video URL">--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="category_id" class="form-label">Category</label>--}}
{{--                <select id="category_id" name="category_id" class="form-control" required>--}}
{{--                    <option value="">Select Category</option>--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}



{{--            <div class="mb-3">--}}
{{--                <label for="image" class="form-label">Image</label>--}}
{{--                <input type="file" id="image" name="image" class="form-control" accept="image/*">--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-primary">Create</button>--}}
{{--        </form>--}}
{{--    </div>--}}


{{--    <script src="https://cdn.ckeditor.com/ckeditor5/latest/ckeditor.js"></script>--}}

{{--    <script>--}}
{{--        ClassicEditor.create( document.querySelector( '#content' ) )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}


{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}



{{--@endsection--}} -->
