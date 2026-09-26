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
          Contact
        </li>

      </ol>
    </nav>

    <div class="title-wrapper">
      <h1>Contact</h1>
      <p>
        Feel free to contact me if you have any questions about my learning journey,
        Laravel development, or improving English. I’m always happy to connect and help.
      </p>
    </div>
  </div>
</div><!-- End Page Title -->

<!-- Contact Section -->
<section id="contact" class="contact section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
      <div class="col-lg-12">
        <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">

          <form id="contactForm" method="POST">
            @csrf

            <div class="row">
              <div class="col-md-6 form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <input type="text" name="name" class="form-control" placeholder="Your name*" required>
                </div>
              </div>

              <div class="col-md-6 form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="email" name="email" class="form-control" placeholder="Your email*" required>
                </div>
              </div>
            </div>

            <div class="form-group mt-3">
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                <textarea class="form-control" name="message" rows="6" placeholder="Write a message*" required></textarea>
              </div>
            </div>

            {{-- reCAPTCHA --}}
            <div class="my-3 text-center">
              <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
              <div id="recaptchaError" class="text-danger mt-2"></div>
            </div>

            <div id="formMessage" class="my-3"></div>

            <div class="text-center">
              <button id="submitBtn" type="submit">Submit Message</button>
            </div>

          </form>

        </div>
      </div>
    </div>

  </div>
</section><!-- /Contact Section -->

@section('foote')
@include('layouts.footer')
@show

{{-- Google reCAPTCHA script --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
  e.preventDefault(); // منع reload

  const form = this;
  const formMessage = document.getElementById('formMessage');
  const recaptchaError = document.getElementById('recaptchaError');
  const submitBtn = document.getElementById('submitBtn');

  // امسح الرسائل السابقة
  formMessage.innerHTML = '';
  recaptchaError.innerText = '';

  // تحقق من reCAPTCHA قبل الإرسال
  if (typeof grecaptcha === 'undefined') {
    formMessage.innerHTML = `<div class="alert alert-danger">reCAPTCHA failed to load. Please refresh the page.</div>`;
    return;
  }

  const recaptchaResponse = grecaptcha.getResponse();
  if (!recaptchaResponse) {
    recaptchaError.innerText = 'Please verify that you are not a robot.';
    return;
  }

  // تعطيل زر الإرسال أثناء الطلب
  submitBtn.disabled = true;
  submitBtn.innerText = 'Sending...';

  try {
    const formData = new FormData(form);

    const response = await fetch("{{ route('contacts.store') }}", {
      method: "POST",
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Accept': 'application/json'
      },
      body: formData
    });

    // إذا Validation فشل (422) نقرأ الأخطاء
    if (response.status === 422) {
      const data = await response.json();

      let errorsHtml = '<div class="alert alert-danger"><ul class="mb-0">';
      for (const key in data.errors) {
        data.errors[key].forEach(msg => {
          errorsHtml += `<li>${msg}</li>`;
        });
      }
      errorsHtml += '</ul></div>';

      formMessage.innerHTML = errorsHtml;

      // إعادة ضبط reCAPTCHA
      grecaptcha.reset();
      return;
    }

    // إذا في خطأ آخر
    if (!response.ok) {
      formMessage.innerHTML = `<div class="alert alert-danger">Something went wrong! Please try again.</div>`;
      grecaptcha.reset();
      return;
    }

    // نجاح
    const data = await response.json();
    formMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

    form.reset();
    grecaptcha.reset();

  } catch (error) {
    formMessage.innerHTML = `<div class="alert alert-danger">Something went wrong! Please try again.</div>`;
    if (typeof grecaptcha !== 'undefined') grecaptcha.reset();
  } finally {
    submitBtn.disabled = false;
    submitBtn.innerText = 'Submit Message';
  }
});
</script>
