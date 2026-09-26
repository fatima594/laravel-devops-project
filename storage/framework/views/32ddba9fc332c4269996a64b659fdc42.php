<section id="category-section" class="category-section section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Category Section</h2>
    <div><span class="description-title">Category Section</span></div>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4 mb-4">

      <?php $__currentLoopData = $categories->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6">
          <article class="featured-post">

            <div class="post-img">
              <img
                 src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" 
                class="img-fluid"
                loading="lazy">
            </div>

            <div class="post-content">
              <div class="category-meta">
                <span class="post-category"><?php echo e($category->name); ?></span>

                <div class="author-meta">

                  <span class="post-date">
                    <?php echo e($category->created_at->format('M d, Y')); ?>

                  </span>
                </div>
              </div>

              <h2 class="title">
                <a href="<?php echo e(route('showpost.show', $category->slug)); ?>">
                  Explore <?php echo e($category->name); ?> Articles
                </a>
              </h2>
            </div>

          </article>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

  </div>
</section>
<?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/categoryhome.blade.php ENDPATH**/ ?>