@extends('admin.dashboard.master')

@section('title', 'Edit About about')

@section('content')
    <div class="container mt-5">
        <h1>Edit About about</h1>
        <form id="editBlogForm" action="{{ route('admin.about.update', $about->id) }}" method="Post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $about->title }}" required>
            </div>
             <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $about->name }}" required>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">body</label>
                <textarea id="content" name="body" class="form-control" rows="5" required>{{ old('body', $about->body) }}</textarea>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                @if ($about->image)
                <img src="{{ asset($about->image) }}" alt="{{ $about->title }}" width="100">
                @else
                    <span>No Image</span>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Update about</button>
        </form>
    </div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editorElement = document.querySelector('#content');

    if (editorElement) {
        ClassicEditor
            .create(editorElement, {   // ✅ نقل الإعدادات هنا
                language: 'en',
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
                ],
                heading: {
                    options: [
                        { model: 'paragraph', view: 'p', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                    ]
                }
            })
            .then(editor => {
                console.log('Editor ready');
            })
            .catch(error => {
                console.error(error);
            });
    }
});
</script>


@endsection
