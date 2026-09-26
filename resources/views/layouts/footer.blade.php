<footer id="footer" class="footer">
  <div class="container footer-top">
    <div class="row gy-4 justify-content-between align-items-start">

      <!-- Logo + Contact + Social Media -->
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <span class="sitename">GrowthAwakening</span><span>.</span>
        </a>

        <div class="footer-contact pt-3">
          <p>Belgium</p>
          <p><strong>Phone:</strong> <span>+32465360597</span></p>
          <p><strong>Email:</strong> <span>lakhalfateima@gmail.com</span></p>
        </div>

        <div class="social-links d-flex mt-3">
          @foreach($socialMedias as $social)
            @if($social->facebook)
              <a href="{{ $social->facebook }}" class="facebook" target="_blank" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
              </a>
            @endif

            @if($social->twitter)
              <a href="{{ $social->twitter }}" class="twitter" target="_blank" aria-label="Twitter">
                <i class="bi bi-twitter-x"></i>
              </a>
            @endif

            @if($social->instagram)
              <a href="{{ $social->instagram }}" class="instagram" target="_blank" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
              </a>
            @endif

            @if($social->linkedin)
              <a href="{{ $social->linkedin }}" class="linkedin" target="_blank" aria-label="LinkedIn">
                <i class="bi bi-linkedin"></i>
              </a>
            @endif

            @if($social->github)
              <a href="{{ $social->github }}" class="github" target="_blank" aria-label="GitHub">
                <i class="bi bi-github"></i>
              </a>
            @endif
          @endforeach
        </div>
      </div>

      <!-- Useful Pages -->
      <div class="col-lg-3 col-md-6 footer-links">
       <h4>Explore</h4>        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('category') }}">Category</a></li>
          <li><a href="{{ route('posts') }}">Posts</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
           <h4>Resources</h4>        <ul>
          <li><a href="{{ url('/about-me') }}">About</a></li>
          <li><a href="{{ url('/contact') }}">Contact</a></li>
          <li><a href="{{url('privacy')}}">Privacy Policy</a></li>
          <li><a href="{{url('Terms&Conditions')}}">Terms & Conditions</a></li>
        </ul>
      </div>

    </div>
  </div>

  <div class="container text-center mt-4">
    <p>© <strong>GrowthAwakening</strong> — All Rights Reserved</p>
  </div>
</footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center" aria-label="Scroll to top">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files (Optimized Loading) -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}" defer></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}" defer></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}" defer></script>
  <script src="{{asset('assets/js/main.js')}}" defer></script>
  
  <!-- Conditional JS: Dynamic Highlight.js for code snippets only -->
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      // Runs Highlight.js only if there is actual code on the page (<pre><code>)
      if (document.querySelector('pre code')) {
        let script = document.createElement('script');
        script.src = "https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js";
        script.onload = function() {
          if (typeof hljs !== 'undefined') {
            hljs.highlightAll();
          }
        };
        document.body.appendChild(script);
      }
    });
  </script>
</body>

</html>