
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

        {{-- Previous page --}}
        @php
          $previousPath = parse_url(url()->previous(), PHP_URL_PATH);
          $currentPath  = request()->getPathInfo();
        @endphp

        @if($previousPath && $previousPath !== $currentPath)
          <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}">
              {{ ucfirst(trim($previousPath, '/')) }}
            </a>
          </li>
        @endif

        {{-- Current page --}}
        <li class="breadcrumb-item active current">
          Categories
        </li>

      </ol>
    </nav>
      </div>
    <div class="page-title position-relative">


      <div class="title-wrapper">
        <h1>Blog Category</h1>
         <p>
        Technology changed the way I learn, think, and solve problems. Through this website, I share my journey from learning Laravel and improving my English to exploring networking, Python, Windows Server, and real-world IT skills.
        </p>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Category Postst Section -->
          <section id="category-postst" class="category-postst section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
              <div class="row gy-4">
                 @foreach($categories as $category)

                <div class="col-lg-6">

                  <article>
                    <div class="post-img">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" onerror="console.error('Image not found: {{ asset($category->image) }}')" class="img-fluid">
                    </div>


                    <h2 class="title">
                      <a href="{{ route('showpost.show', $category->slug) }}">{{$category->name}}</a>
                    </h2>

                    <div class="d-flex align-items-center">
                      <div class="post-meta">
                        <p class="post-date">
                          <time datetime="2022-01-01">{{ $category->created_at->format('M d, Y') }}</time>
                        </p>
                      </div>
                    </div>

                  </article>

                </div><!-- End post list item -->

             @endforeach


              </div>
            </div>

          </section><!-- /Category Postst Section -->



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
                <li><a href="{{ route('showpost.show', $category->slug) }}">{{$category->name}}</a></li>
               @endforeach

              </ul>

            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
           <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>

                 @foreach($posts as $post)
                 <div class="post-item">
                   <img src="{{ asset('storage/' . $post->image) }}"
                            alt="{{ $post->image_alt ?? $post->title }}" class="flex-shrink-0" onerror="this.src='{{ asset('assets/img/default.jpg') }}'">
                <div>
                <h4>
                    <a href="{{ route('post.single', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </h4>

                <time datetime="{{ $post->created_at->toDateString() }}">
                    {{ $post->created_at->format('M d, Y') }}
                </time>
            </div>

        </div>
    @endforeach

</div><!-- End Recent Posts Widget -->



          </div>

        </div>

      </div>
    </div>

@section('footer')
@include('layouts.footer')
@show

