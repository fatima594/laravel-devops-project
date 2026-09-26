<section id="latest-posts" class="latest-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Latest Posts</h2>
        <div><span>Check Our</span> <span class="description-title">Latest Posts</span></div>
      </div><!-- End Section Title -->

       <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

      @foreach($posts->take(6) as $post)
        <div class="col-lg-4 col-md-6">

          <article class="post-item">

            <div class="post-img">
              <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->image_alt }}" class="img-fluid">
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
              {{-- <img src="{{ asset('assets/img/person/fatimalakhal.jpg') }}"
                   alt="Fatima Lakhal"
                   class="img-fluid post-author-img flex-shrink-0"> --}}

              <div class="post-meta">
                {{-- <p class="post-author">Fatima Lakhal</p> --}}
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
