<section id="call-to-action" class="call-to-action section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="cta-content" data-aos="fade-up" data-aos-delay="200">
          <h2>Follow My Learning Journey</h2>
          <p>
           I share my learning journey in Laravel, Networking, Python, and Windows Server,
            covering practical projects, troubleshooting tips, and real-world experiences.
            Join me as I explore new technologies and continue growing in web development and IT.
          </p>

          <form id="subscribeForm" class="cta-form d-flex justify-content-center">
            @csrf
            <div class="input-group mb-3 w-75">
              <input type="email" name="email" id="email" class="form-control"
                     placeholder="your email...." required>
              <button class="btn btn-primary" type="submit">Join the Journey</button>
            </div>
          </form>

          <!-- الرسائل تظهر هنا -->
          <div id="form-message" class="mt-3 text-center"></div>

        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

  $('#subscribeForm').submit(function(e) {
    e.preventDefault(); // منع الفورم التقليدي

    let email = $('#email').val();
    let token = $('input[name="_token"]').val();

    $.ajax({
      url: "{{ route('subscribe') }}",
      type: "POST",
      data: {
        email: email,
        _token: token
      },
      success: function(response) {
        // عرض رسالة نجاح
        $('#form-message').html(
          '<div class="alert alert-success">' + response.success + '</div>'
        );
        $('#subscribeForm')[0].reset(); // تفريغ الفورم
      },
      error: function(xhr) {
        let errors = xhr.responseJSON.errors;
        if (errors && errors.email) {
          $('#form-message').html(
            '<div class="alert alert-danger">' + errors.email[0] + '</div>'
          );
        } else {
          $('#form-message').html(
            '<div class="alert alert-danger">Something went wrong!</div>'
          );
        }
      }
    });

  });

});
</script>
