<section id="category-section" class="category-section section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Category Section</h2>
    <div><span class="description-title">Category Section</span></div>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4 mb-4">

      @foreach($categories->take(3) as $category)
        <div class="col-lg-4 col-md-6">
          <article class="featured-post">

            <div class="post-img">
              <img
                 src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                class="img-fluid"
                loading="lazy">
            </div>

            <div class="post-content">
              <div class="category-meta">
                <span class="post-category">{{ $category->name }}</span>

                <div class="author-meta">

                  <span class="post-date">
                    {{ $category->created_at->format('M d, Y') }}
                  </span>
                </div>
              </div>

              <h2 class="title">
                <a href="{{ route('showpost.show', $category->slug) }}">
                  Explore {{ $category->name }} Articles
                </a>
              </h2>
            </div>

          </article>
        </div>
      @endforeach

    </div>

  </div>
</section>
