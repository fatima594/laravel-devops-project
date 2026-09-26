@extends('admin.dashboard.master')

@section('title', 'Edit Blog Post')

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
    <div class="container mt-5">
        <h1>Edit Blog Post</h1>
        <form id="editBlogForm" action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>
             <div class="mb-3">
                      <label class="form-label">Meta Title</label>
                       <input type="text" name="meta_title" class="form-control"
                       value="{{ old('meta_title', $post->meta_title) }}">
           </div>

           <div class="mb-3">
               <label class="form-label">Meta Description</label>
                     <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
              </div>
            <div class="mb-3">
                <label for="body" class="form-label">body</label>
                <textarea id="content" name="body" class="form-control" rows="5" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


    <div class="mb-3">
    <label class="form-label">Image Alt</label>
    <input type="text" name="image_alt" class="form-control" required
           value="{{ old('image_alt', $post->image_alt) }}">
</div>


            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                @if ($post->image)
                <img src="{{ asset($post->image) }}" alt="{{ $post->image_alt  }}" width="100">
                @else
                    <span>No Image</span>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update Post</button>
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

