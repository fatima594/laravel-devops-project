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
          Posts
        </li>

      </ol>
    </nav>
      </div>
<h1 class="sidebar-title mt-5 mb-4 text-center">All Posts</h1>

<hr>
<hr>

<div class="row g-4">
    @foreach($posts as $post)
        <div class="col-lg-4 col-md-6">
<div class="card h-100 border-0 shadow-sm text-center"
     style="transition: transform 0.3s; width: 80%; margin: auto;">

    <!-- صورة المقال -->
    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->image_alt }}"
         class="card-img-top"
         style="width: 100%; height: auto; border-radius: 8px 8px 0 0;">

                <div class="card-body">
                  <h5 class="card-title">
    <a href="{{ route('post.single', $post->slug) }}" class="text-decoration-none text-dark">
        {{ $post->title }}
    </a>
</h5>
                  

     <a href="{{ route('post.single', $post->slug) }}"
   class="btn btn-outline-dark btn-sm"
   onmouseover="this.style.backgroundColor='#db85ea'; this.style.color='black'; this.style.borderColor='#db85ea';"
   onmouseout="this.style.backgroundColor=''; this.style.color=''; this.style.borderColor='';">
    Read More
</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@section('footer')
@include('layouts.footer')
@show

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px) scale(1.03)';
            card.style.transition = 'all 0.4s ease';
            card.classList.add('shadow-lg');
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
            card.classList.remove('shadow-lg');
        });
    });
});
</script>
