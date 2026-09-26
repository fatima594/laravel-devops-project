<section id="featured-posts" class="featured-posts section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Featured Posts</h2>
    <div><span>Check Our</span> <span class="description-title">Featured Posts</span></div>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="blog-posts-slider swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 800,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": 3,
          "spaceBetween": 30,
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 20
            },
            "768": {
              "slidesPerView": 2,
              "spaceBetween": 20
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 30
            }
          }
        }
      </script>

      <div class="swiper-wrapper">

        @foreach($posts as $post)
          <div class="swiper-slide">
            <div class="blog-post-item">

              <!-- جميع صور السلايدر تأخذ loading="lazy" فقط -->
              <img src="{{ asset('storage/'.$post->image) }}" 
                   alt="{{ $post->image_alt ?? $post->title }}" 
                   class="img-fluid"
                   loading="lazy"
                   onerror="this.remove();">

              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> Fateima Lakhal</span>


                </div>

                <h2>
                  <a href="{{ route('post.single', $post->slug) }}">
                    {{ $post->title }}
                  </a>
                </h2>

                <p>
                  {!! \Illuminate\Support\Str::words(strip_tags($post->body), 50, '...') !!}
                </p>

                <a href="{{ route('post.single', $post->slug) }}" class="read-more">
                  Read More <i class="bi bi-arrow-right"></i>
                </a>
              </div>

            </div>
          </div>
        @endforeach

      </div>

    </div>

  </div>

</section>