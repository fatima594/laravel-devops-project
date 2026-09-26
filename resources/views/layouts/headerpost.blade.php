@if($post = $headerposts->first())
  @push('preload')
    <link rel="preload" as="image" href="{{ asset('storage/'.$post->image) }}" fetchpriority="high">
  @endpush
@endif

<!-- Blog Hero Section -->
<section id="blog-hero" class="blog-hero section">
  <div class="container">
    <div class="blog-grid">

      <!-- 1. Featured Post (LCP Element) -->
      <article class="blog-item featured">
        @if($post = $headerposts->first())
          <img src="{{ asset('storage/'.$post->image) }}"
               alt="{{ $post->image_alt }}"
               class="img-fluid"
               fetchpriority="high"
               decoding="sync"
               width="800"
               height="450">

          <div class="blog-content">
            <div class="post-meta">
              <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
              <span class="category">{{ $post->category->name }}</span>
            </div>
            <h2 class="post-title">
              <a href="{{ route('post.single', $post->slug) }}">
                {{ $post->title }}
              </a>
            </h2>
          </div>
        @endif
      </article>

      <!-- 2. Regular Post (أيضاً في أعلى الشاشة) -->
      <article class="blog-item" data-aos="fade-up" data-aos-delay="100">
        @if($post = $learnposts->first())
          <img src="{{ asset('storage/'.$post->image) }}"
               alt="{{ $post->image_alt }}"
               class="img-fluid"
               fetchpriority="high"
               decoding="sync"
               width="400"
               height="250">

          <div class="blog-content">
            <div class="post-meta">
              <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
              <span class="category">{{ $post->category->name }}</span>
            </div>
            <h3 class="post-title">
              <a href="{{ route('post.single', $post->slug) }}">
                {{ $post->title }}
              </a>
            </h3>
          </div>
        @endif
      </article>

      <!-- 3. Tips Posts -->
      @foreach($tipsposts->take(3) as $index => $post)
        <article class="blog-item" data-aos="fade-up" data-aos-delay="200">
          <img src="{{ asset('storage/'.$post->image) }}"
               alt="{{ $post->image_alt }}"
               class="img-fluid"
               @if($index > 0) loading="lazy" @endif
               decoding="async"
               width="400"
               height="250">

          <div class="blog-content">
            <div class="post-meta">
              <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
              <span class="category">{{ $post->category->name }}</span>
            </div>

            <h3 class="post-title">
              <a href="{{ route('post.single', $post->slug) }}">
                {{ $post->title }}
              </a>
            </h3>
          </div>
        </article>
      @endforeach

    </div>
  </div>
</section>