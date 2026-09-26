<h6 class="sidebar-title mt-5 mb-4">Popular Posts</h6>
<div class="card mb-4">
    @foreach($popularposts as $post)

    <a href="single-post.html" class="overlay-link"></a>
    <div class="card-header p-0">
        <div class="blog-media">
            <img src="{{ asset($post->image) }}" alt="{{ $post->image_alt }}"class="w-100" style=width:50%; height:0%; object-fit: cover; border-radius: 8px 8px 0 0; transition: transform 0.3s;>
            <a href="#" class="badge badge-primary">#Lorem</a>
        </div>
    </div>
    <div class="card-body px-0">
        <h5 class="card-title mb-2">{{$post->title}}</h5>
        <small class="small text-muted"><i class="ti-calendar pr-1"></i><span>Fatima Lakhal - {{ $post->created_at->format('F d, Y') }}</span></small>

    </div>
    @endforeach

</div>
@foreach($posts->take(3) as $post)

<div class="media text-left mb-4">
    <a href="single-post.html" class="overlay-link"></a>
    <img src="{{ asset($post->image) }}" alt="{{ $post->image_alt }}" class="mr-3" style=width:50%; height:0%; object-fit: cover; border-radius: 8px 8px 0 0; transition: transform 0.3s;>
    <div class="media-body">
        <h6 class="mt-0">{{$post->title}}</h6>
    </div>
</div>

@endforeach
