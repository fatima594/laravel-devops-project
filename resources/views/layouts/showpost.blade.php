@section('header')
@include('layouts.header')
@show


    <!-- Page Title -->
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="bi bi-house"></i> Home</a></li>
            <li class="breadcrumb-item active current">Categories</li>
          </ol>
        </nav>
      </div>


<section id="latest-posts" class="latest-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Latest Posts</h2>
      </div><!-- End Section Title -->

       <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

      @foreach($posts as $post)
        <div class="col-lg-4 col-md-6">

          <article class="post-item">

            <div class="post-img">
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->image_alt }}"
                   class="card-img-top"
                   style="width: 100%; height: auto; border-radius: 8px 8px 0 0;">
          </div>

            <p class="post-category">
              {{ $post->category->name ?? 'Uncategorized' }}
            </p>

            <h2 class="title">
              <a href="{{ route('post.single', $post->slug) }}">
                {{ $post->title }}
              </a>
            </h2>

            <div class="d-flex align-items-center">


              <div class="post-meta">
                <p class="post-date">
                  <time datetime="{{ $post->created_at->toDateString() }}">
                    {{ $post->created_at->format('M d, Y') }}
                  </time>
                </p>
              </div>
            </div>

          </article>

        </div>
      @endforeach

    </div>
  </div>

    </section>
@section('footer')
@include('layouts.footer')
@show
