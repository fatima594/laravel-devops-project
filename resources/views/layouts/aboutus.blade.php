@section('header')
@include('layouts.header')
@show
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
          About-Me
        </li>

      </ol>
    </nav>
      </div>

      <div class="title-wrapper">
        <h1>About</h1>
        <p>
        Technology changed the way I learn, think, and solve problems. Through this website, I share my journey from learning Laravel and improving my English to exploring networking, Python, Windows Server, and real-world IT skills.
        </p>
      </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
   <section id="about" class="about section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <span class="section-badge">
      <i class="bi bi-person"></i> About Me
    </span>

    <div class="row align-items-center">

      <!-- الصورة الشخصية -->
      <div class="col-lg-4 text-center">
        <img src="{{asset('assets/img/person/aboutphoto.jpg')}}"
             class="img-fluid rounded-circle mb-3"
             alt="My Photo">
      </div>

      <!-- المقال -->
      <div class="col-lg-8">
        @foreach($abouts as $about)

        <h2 class="about-title">{{$about->title}}</h2>

        <p class="about-description">
         {!! trim(html_entity_decode($about->body)) !!}
        </p>

      </div>
        @endforeach

    </div>
  </div>

</section>


  @section('footer')
  @include('layouts.footer')
  @show
