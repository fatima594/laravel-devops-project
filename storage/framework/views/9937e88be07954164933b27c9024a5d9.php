  <section id="blog-comments" class="blog-comments section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

              <div class="blog-comments-3">
                <div class="section-header">
                  <h3>Discussion <span id="comment-count" class="comment-count"><?php echo e($post->comments->count()); ?></span></h3>
                </div>

                <div class="comments-wrapper">
                  <!-- Comment 1 -->
                  <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <article class="comment-card">
                    <div class="comment-header">
                      <div class="user-info">
                        <div class="meta">
                          <h4 class="name"><?php echo e($comment->name); ?></h4>
                          <span class="date"><i class="bi bi-calendar3"></i> <?php echo e($comment->created_at->format('M d, Y')); ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="comment-content">
                      <p><?php echo e($comment->body); ?>.</p>
                    </div>
                    <div class="comment-actions">
                      <button class="action-btn like-btn">
                        <i class="bi bi-hand-thumbs-up"></i>
                        <span>12</span>
                      </button>
                      <button class="action-btn reply-btn">
                        <i class="bi bi-reply"></i>
                        <span>Reply</span>
                      </button>
                    </div>

                  </article>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
              </div>

            </div>

          </section>


 <section id="blog-comment-form" class="blog-comment-form section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                 <div id="success-message" style="display: none; color: green; font-weight: bold; margin-bottom: 10px;">
                           Your Comment Has Added Successfully!
                </div>
                 <form id="comment-form"
                        action="<?php echo e(route('comments.store', $post->id)); ?>" method="POST" role="form">
                    <?php echo csrf_field(); ?>

                <div class="section-header">
                  <h3>Share Your Thoughts</h3>
                  <p>Your email address will not be published. Required fields are marked *</p>
                </div>

                <div class="row gy-3">
                  <div class="col-md-6 form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required="">
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required="">
                  </div>

                  <div class="col-12 form-group">
                    <label for="comment">Your Comment *</label>
                    <textarea class="form-control" name="body" id="comment" rows="5" placeholder="Write your thoughts here..." required=""></textarea>
                  </div>
                     
            <div class="my-3 text-center">
              <div class="g-recaptcha" data-sitekey="<?php echo e(config('services.recaptcha.site_key')); ?>"></div>
              <div id="recaptchaError" class="text-danger mt-2"></div>
            </div>

            <div id="formMessage" class="my-3"></div>
                  <button type="submit" class="btn-submit" id="submitBtn">
    Post Comment
</button>
                    </div>

                    </form>

                      </div>

             </section>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


<script>
document.getElementById('comment-form').addEventListener('submit', async function(e) {
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

    const response = await fetch("<?php echo e(route('comments.store', $post->id)); ?>" ,{
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


<?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/comment.blade.php ENDPATH**/ ?>