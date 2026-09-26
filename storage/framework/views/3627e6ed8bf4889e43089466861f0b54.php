<section id="latest-posts" class="latest-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Latest Posts</h2>
        <div><span>Check Our</span> <span class="description-title">Latest Posts</span></div>
      </div><!-- End Section Title -->

       <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">

      <?php $__currentLoopData = $posts->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6">

          <article class="post-item">

            <div class="post-img">
              <img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="<?php echo e($post->image_alt); ?>" class="img-fluid">
            </div>

            <p class="post-category">
              <?php echo e($post->category->name ?? 'Uncategorized'); ?>

            </p>

            <h2 class="title">
              <a href="<?php echo e(route('post.single', $post->slug)); ?>">
                <?php echo e($post->title); ?>

              </a>
            </h2>

            <div class="d-flex align-items-center">
              

              <div class="post-meta">
                
                <p class="post-date">
                  <time datetime="<?php echo e($post->created_at->toDateString()); ?>">
                    <?php echo e($post->created_at->format('M d, Y')); ?>

                  </time>
                </p>
              </div>
            </div>

          </article>

        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
  </div>

    </section>
<?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/latestpost.blade.php ENDPATH**/ ?>