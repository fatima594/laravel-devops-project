<?php if($post = $headerposts->first()): ?>
  <?php $__env->startPush('preload'); ?>
    <link rel="preload" as="image" href="<?php echo e(asset('storage/'.$post->image)); ?>" fetchpriority="high">
  <?php $__env->stopPush(); ?>
<?php endif; ?>

<!-- Blog Hero Section -->
<section id="blog-hero" class="blog-hero section">
  <div class="container">
    <div class="blog-grid">

      <!-- 1. Featured Post (LCP Element) -->
      <article class="blog-item featured">
        <?php if($post = $headerposts->first()): ?>
          <img src="<?php echo e(asset('storage/'.$post->image)); ?>"
               alt="<?php echo e($post->image_alt); ?>"
               class="img-fluid"
               fetchpriority="high"
               decoding="sync"
               width="800"
               height="450">

          <div class="blog-content">
            <div class="post-meta">
              <span class="date"><?php echo e($post->created_at->format('M d, Y')); ?></span>
              <span class="category"><?php echo e($post->category->name); ?></span>
            </div>
            <h2 class="post-title">
              <a href="<?php echo e(route('post.single', $post->slug)); ?>">
                <?php echo e($post->title); ?>

              </a>
            </h2>
          </div>
        <?php endif; ?>
      </article>

      <!-- 2. Regular Post (أيضاً في أعلى الشاشة) -->
      <article class="blog-item" data-aos="fade-up" data-aos-delay="100">
        <?php if($post = $learnposts->first()): ?>
          <img src="<?php echo e(asset('storage/'.$post->image)); ?>"
               alt="<?php echo e($post->image_alt); ?>"
               class="img-fluid"
               fetchpriority="high"
               decoding="sync"
               width="400"
               height="250">

          <div class="blog-content">
            <div class="post-meta">
              <span class="date"><?php echo e($post->created_at->format('M d, Y')); ?></span>
              <span class="category"><?php echo e($post->category->name); ?></span>
            </div>
            <h3 class="post-title">
              <a href="<?php echo e(route('post.single', $post->slug)); ?>">
                <?php echo e($post->title); ?>

              </a>
            </h3>
          </div>
        <?php endif; ?>
      </article>

      <!-- 3. Tips Posts -->
      <?php $__currentLoopData = $tipsposts->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="blog-item" data-aos="fade-up" data-aos-delay="200">
          <img src="<?php echo e(asset('storage/'.$post->image)); ?>"
               alt="<?php echo e($post->image_alt); ?>"
               class="img-fluid"
               <?php if($index > 0): ?> loading="lazy" <?php endif; ?>
               decoding="async"
               width="400"
               height="250">

          <div class="blog-content">
            <div class="post-meta">
              <span class="date"><?php echo e($post->created_at->format('M d, Y')); ?></span>
              <span class="category"><?php echo e($post->category->name); ?></span>
            </div>

            <h3 class="post-title">
              <a href="<?php echo e(route('post.single', $post->slug)); ?>">
                <?php echo e($post->title); ?>

              </a>
            </h3>
          </div>
        </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
  </div>
</section><?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/headerpost.blade.php ENDPATH**/ ?>