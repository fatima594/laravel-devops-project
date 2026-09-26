@section('meta_title', $post->meta_title ?? $post->title)

@section('meta_description', $post->meta_description ?? \Illuminate\Support\Str::words(strip_tags($post->body), 25))

@section('header')
    @include('layouts.header')
@show

    <!-- Page Title -->
<!-- Page Title -->
<div class="page-title">
  <div class="breadcrumbs">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">

        {{-- Home --}}
        <li class="breadcrumb-item">
          <a href="{{ url('/') }}">
            <i class="bi bi-house"></i> Home
          </a>
        </li>



        {{-- Single Post Title --}}
        <li class="breadcrumb-item active current">
          {{ $post->title }}
        </li>

      </ol>
    </nav>
  </div>

<!-- End Page Title -->


      <div class="title-wrapper">
        <h1>Blog Details</h1>
         <p>
        Technology changed the way I learn, think, and solve problems. Through this website, I share my journey from learning Laravel and improving my English to exploring networking, Python, Windows Server, and real-world IT skills.
         </p>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container" data-aos="fade-up">

              <article class="article">

                <div class="hero-img" data-aos="zoom-in">
<img src="{{ asset('storage/'.$post->image) }}"
     alt="{{ $post->image_alt ?: $post->title }}"
     class="img-fluid"
     loading="lazy">
                  {{-- <div class="meta-overlay">
                    <div class="meta-categories">
                      <a href="#" class="category">{{$post->category->name}}</a>
                    </div>
                  </div> --}}
                </div>

                <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                  <div class="content-header">
                    <h1 class="title">{{$post->title}}</h1>

                  </div>


                <div class="content">
                          {!! html_entity_decode($post->body) !!}
               </div>
                </div>

              </article>

            </div>
          </section><!-- /Blog Details Section -->

          <!-- Blog Author Section -->
          <section id="blog-author" class="blog-author section">

            <div class="container" data-aos="fade-up">
              <div class="author-box">
                <div class="row align-items-center">
                  <div class="col-lg-3 col-md-4 text-center">

                    <div class="author-social-links mt-3">
                         @foreach($socialMedias as $social)
                @if($social->facebook)
                <a href="{{ $social->facebook }}" class="facebook" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
                @endif

            @if($social->twitter)
                <a href="{{ $social->twitter }}" class="twitter" target="_blank">
                    <i class="bi bi-twitter-x"></i>
                </a>
            @endif

            @if($social->instagram)
                <a href="{{ $social->instagram }}" class="instagram" target="_blank">
                    <i class="bi bi-instagram"></i>
                </a>
            @endif

            @if($social->linkedin)
                <a href="{{ $social->linkedin }}" class="linkedin" target="_blank">
                    <i class="bi bi-linkedin"></i>
                </a>
            @endif

            @if($social->github)
                <a href="{{ $social->github }}" class="github" target="_blank">
                    <i class="bi bi-github"></i>
                </a>
            @endif
        @endforeach
                    </div>
                  </div>

                  <div class="col-lg-9 col-md-8">
                    <div class="author-content">
                      <h3 class="author-name">Fatima Lakhal </h3>
                      <span class="author-title">Laravel &amp; Developer</span>

                     <div class="author-bio mt-3">
                         Hi, I'm Fatima Lakhal. This website documents my journey through Laravel development, networking, Python, Windows Server, and continuous learning. I share practical solutions, lessons learned, and beginner-friendly guides to help others overcome challenges and grow in technology.
                     </div>

                      <div class="author-website mt-3">
                        <a href="#" class="website-link">
                          <i class="bi bi-globe"></i>
                        </a>
                        <a href="{{url('about-me')}}" class="more-posts">
                          Read More About Me <i class="bi bi-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </section><!-- /Blog Author Section -->



          <!-- Blog Comment Form Section -->
          @section('comment')
          @include('layouts.comment')
          @show
         <!-- /Blog Comment Form Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->



            <!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>
              <ul class="mt-3">
                @foreach($categories as $category)

                <li><a href="{{route('showpost.show', $category->slug) }}">{{$category->name}}</a></li>
                @endforeach

              </ul>

            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Laravel Posts</h3>
             @foreach($posts as $post )

              <div class="post-item">
                     <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->image_alt }}" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('post.single' ,$post->slug)}}">{{$post->title}}</a></h4>
                  <time datetime="2020-01-01">{{ $post->created_at->format('M d, Y') }}</time>
                </div>
              </div><!-- End recent post item-->

@endforeach

            </div><!--/Recent Posts Widget -->


                   <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Network Posts</h3>
             @foreach($networkingposts as $networkingpost )

              <div class="post-item">
                     <img src="{{ asset('storage/'.$networkingpost->image) }}" alt="{{ $networkingpost->image_alt }}" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('post.single' ,$networkingpost->slug)}}">{{$networkingpost->title}}</a></h4>
                  <time datetime="2020-01-01">{{ $networkingpost->created_at->format('M d, Y') }}</time>
                </div>
              </div><!-- End recent post item-->

@endforeach

            </div><!--/Recent Posts Widget -->



          </div>

        </div>

      </div>
    </div>

  @section('footer')
@include('layouts.footer')
@show
<style>
.content {
    line-height: 1.9;
    font-size: 18px;
    color: #333;
}

.content h1,
.content h2,
.content h3 {
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 700;
}

.content h2 {
    border-left: 4px solid #db85ea;
    padding-left: 10px;
}

.content p {
    margin-bottom: 18px;
}

.content img {
    max-width: 100%;
    border-radius: 12px;
    margin: 25px 0;
}

.content blockquote {
    border-left: 4px solid #ddd;
    padding-left: 15px;
    color: #666;
    font-style: italic;
}
.content {
    overflow: hidden;
}

.content img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 10px; /* optional */
}


.content code {
    font-family: Consolas, monospace;
}

.content pre {
    background: #0d1117;
    color: #e6edf3;
    padding: 16px;
    border-radius: 10px;

    max-width: 800px;   /* 🔥 أهم سطر */
    margin: 20px auto;  /* توسيط */

    overflow-x: auto;
    font-size: 14px;
}
.content p {
  margin-bottom: 5px;
}
.article-content .content {
    padding: 0 10px;
}
.article-content {
    max-width: 680px;
    margin: 0 auto;
}

.content {
    font-size: 18px;
    line-height: 2;
}
@media (max-width: 768px) {
    .hero-img {
        height: auto !important;
    }

    .hero-img img {
        height: auto !important;
        object-fit: contain;
    }
}
/* Article Links */
.content a {
    color: #6d28d9;
    font-weight: 600;
    text-decoration: none;
    transition: color .2s ease;
}

.content a:visited {
    color: #7c3aed;
}

.content a:hover {
    color: #5b21b6;
    text-decoration: underline;
}

.content a:active {
    color: #4c1d95;
}


</style>
