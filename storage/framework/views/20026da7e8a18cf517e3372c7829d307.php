<?php $__env->startSection('meta_title', $post->meta_title ?? $post->title); ?>

<?php $__env->startSection('meta_description', $post->meta_description ?? \Illuminate\Support\Str::words(strip_tags($post->body), 25)); ?>

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldSection(); ?>

    <!-- Page Title -->
<!-- Page Title -->
<div class="page-title">
  <div class="breadcrumbs">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">

        
        <li class="breadcrumb-item">
          <a href="<?php echo e(url('/')); ?>">
            <i class="bi bi-house"></i> Home
          </a>
        </li>



        
        <li class="breadcrumb-item active current">
          <?php echo e($post->title); ?>

        </li>

      </ol>
    </nav>
  </div>

<!-- End Page Title -->


      <div class="title-wrapper">
        <h1>Blog Details</h1>
         <p>
        Technology changed the way I learn, think, and solve problems. Through this website, I share my journey from learning Laravel and improving my English to exploring networking, Python, Windows Server, and real-world IT skills.
         </p>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container" data-aos="fade-up">

              <article class="article">

                <div class="hero-img" data-aos="zoom-in">
<img src="<?php echo e(asset('storage/'.$post->image)); ?>"
     alt="<?php echo e($post->image_alt ?: $post->title); ?>"
     class="img-fluid"
     loading="lazy">
                  
                </div>

                <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                  <div class="content-header">
                    <h1 class="title"><?php echo e($post->title); ?></h1>

                  </div>


                <div class="content">
                          <?php echo html_entity_decode($post->body); ?>

               </div>
                </div>

              </article>

            </div>
          </section><!-- /Blog Details Section -->

          <!-- Blog Author Section -->
          <section id="blog-author" class="blog-author section">

            <div class="container" data-aos="fade-up">
              <div class="author-box">
                <div class="row align-items-center">
                  <div class="col-lg-3 col-md-4 text-center">

                    <div class="author-social-links mt-3">
                         <?php $__currentLoopData = $socialMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($social->facebook): ?>
                <a href="<?php echo e($social->facebook); ?>" class="facebook" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
                <?php endif; ?>

            <?php if($social->twitter): ?>
                <a href="<?php echo e($social->twitter); ?>" class="twitter" target="_blank">
                    <i class="bi bi-twitter-x"></i>
                </a>
            <?php endif; ?>

            <?php if($social->instagram): ?>
                <a href="<?php echo e($social->instagram); ?>" class="instagram" target="_blank">
                    <i class="bi bi-instagram"></i>
                </a>
            <?php endif; ?>

            <?php if($social->linkedin): ?>
                <a href="<?php echo e($social->linkedin); ?>" class="linkedin" target="_blank">
                    <i class="bi bi-linkedin"></i>
                </a>
            <?php endif; ?>

            <?php if($social->github): ?>
                <a href="<?php echo e($social->github); ?>" class="github" target="_blank">
                    <i class="bi bi-github"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>

                  <div class="col-lg-9 col-md-8">
                    <div class="author-content">
                      <h3 class="author-name">Fatima Lakhal </h3>
                      <span class="author-title">Laravel &amp; Developer</span>

                     <div class="author-bio mt-3">
                         Hi, I'm Fatima Lakhal. This website documents my journey through Laravel development, networking, Python, Windows Server, and continuous learning. I share practical solutions, lessons learned, and beginner-friendly guides to help others overcome challenges and grow in technology.
                     </div>

                      <div class="author-website mt-3">
                        <a href="#" class="website-link">
                          <i class="bi bi-globe"></i>
                        </a>
                        <a href="<?php echo e(url('about-me')); ?>" class="more-posts">
                          Read More About Me <i class="bi bi-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </section><!-- /Blog Author Section -->



          <!-- Blog Comment Form Section -->
          <?php $__env->startSection('comment'); ?>
          <?php echo $__env->make('layouts.comment', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          <?php echo $__env->yieldSection(); ?>
         <!-- /Blog Comment Form Section -->

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
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li><a href="<?php echo e(route('showpost.show', $category->slug)); ?>"><?php echo e($category->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </ul>

            </div><!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Laravel Posts</h3>
             <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <div class="post-item">
                     <img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="<?php echo e($post->image_alt); ?>" class="flex-shrink-0">
                <div>
                  <h4><a href="<?php echo e(route('post.single' ,$post->slug)); ?>"><?php echo e($post->title); ?></a></h4>
                  <time datetime="2020-01-01"><?php echo e($post->created_at->format('M d, Y')); ?></time>
                </div>
              </div><!-- End recent post item-->

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div><!--/Recent Posts Widget -->


                   <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Network Posts</h3>
             <?php $__currentLoopData = $networkingposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $networkingpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <div class="post-item">
                     <img src="<?php echo e(asset('storage/'.$networkingpost->image)); ?>" alt="<?php echo e($networkingpost->image_alt); ?>" class="flex-shrink-0">
                <div>
                  <h4><a href="<?php echo e(route('post.single' ,$networkingpost->slug)); ?>"><?php echo e($networkingpost->title); ?></a></h4>
                  <time datetime="2020-01-01"><?php echo e($networkingpost->created_at->format('M d, Y')); ?></time>
                </div>
              </div><!-- End recent post item-->

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div><!--/Recent Posts Widget -->



          </div>

        </div>

      </div>
    </div>

  <?php $__env->startSection('footer'); ?>
<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldSection(); ?>
<style>
.content {
    line-height: 1.9;
    font-size: 18px;
    color: #333;
}

.content h1,
.content h2,
.content h3 {
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 700;
}

.content h2 {
    border-left: 4px solid #db85ea;
    padding-left: 10px;
}

.content p {
    margin-bottom: 18px;
}

.content img {
    max-width: 100%;
    border-radius: 12px;
    margin: 25px 0;
}

.content blockquote {
    border-left: 4px solid #ddd;
    padding-left: 15px;
    color: #666;
    font-style: italic;
}
.content {
    overflow: hidden;
}

.content img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 10px; /* optional */
}


.content code {
    font-family: Consolas, monospace;
}

.content pre {
    background: #0d1117;
    color: #e6edf3;
    padding: 16px;
    border-radius: 10px;

    max-width: 800px;   /* 🔥 أهم سطر */
    margin: 20px auto;  /* توسيط */

    overflow-x: auto;
    font-size: 14px;
}
.content p {
  margin-bottom: 5px;
}
.article-content .content {
    padding: 0 10px;
}
.article-content {
    max-width: 680px;
    margin: 0 auto;
}

.content {
    font-size: 18px;
    line-height: 2;
}
@media (max-width: 768px) {
    .hero-img {
        height: auto !important;
    }

    .hero-img img {
        height: auto !important;
        object-fit: contain;
    }
}
/* Article Links */
.content a {
    color: #6d28d9;
    font-weight: 600;
    text-decoration: none;
    transition: color .2s ease;
}

.content a:visited {
    color: #7c3aed;
}

.content a:hover {
    color: #5b21b6;
    text-decoration: underline;
}

.content a:active {
    color: #4c1d95;
}


</style>
<?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/single-post.blade.php ENDPATH**/ ?>