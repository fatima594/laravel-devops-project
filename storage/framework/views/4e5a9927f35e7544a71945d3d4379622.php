<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $__env->yieldContent('meta_title', 'Growth Awakening — Learning Laravel From Confusion to Clarity'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Personal stories about learning Laravel, overcoming doubt, building real projects, and growing step by step—without hype or shortcuts.'); ?>">

  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?php echo e(asset('assets/img/favicon.png')); ?>" rel="icon">
  <link href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>" rel="apple-touch-icon">

  <!-- 1. Preconnect Connections -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- 2. Corrected Preload for Critical CSS -->
  <link rel="preload" href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" as="style">
  <link rel="preload" href="<?php echo e(asset('assets/css/main.css')); ?>" as="style">

  <!-- 3. Dynamic LCP Preload (يطبع رابط صورة الـ LCP من صفحات الـ Blade) -->
  <?php echo $__env->yieldPushContent('preload'); ?>

  <!-- 4. Google Fonts Non-blocking with display=swap -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap" media="print" onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap">
  </noscript>

  <!-- 5. Critical CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

  <!-- 6. Non-Critical Secondary CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/aos/aos.css')); ?>" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.css')); ?>" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/glightbox/css/glightbox.min.css')); ?>" media="print" onload="this.media='all'">

  <noscript>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/aos/aos.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/glightbox/css/glightbox.min.css')); ?>">
  </noscript>

  <!-- 7. Optimized Google Tag Manager -->
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      let gtmLoaded = false;
      function loadGTM() {
        if (gtmLoaded) return;
        gtmLoaded = true;
        let script = document.createElement('script');
        script.async = true;
        script.src = 'https://www.googletagmanager.com/gtag/js?id=G-LT09FJELGE';
        document.head.appendChild(script);

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-LT09FJELGE');
      }

      ['touchstart', 'scroll', 'mousemove', 'keydown'].forEach(evt => window.addEventListener(evt, loadGTM, {once: true, passive: true}));
      setTimeout(loadGTM, 3500);
    });
  </script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4612534539024922"
     crossorigin="anonymous"></script>

</head>

<body class="index-page">

  <header id="header" class="header position-relative">
    <div class="container-fluid container-xl position-relative">

      <!-- Top Row: Logo + Social + Search -->
      <div class="top-row d-flex align-items-center justify-content-between">
        <a href="<?php echo e(url('/')); ?>" class="logo d-flex align-items-end">
          <h1 class="sitename">GrowthAwakening</h1><span>.</span>
        </a>

        <div class="d-flex align-items-center">
          <div class="social-links">
            <?php $__currentLoopData = $socialMedias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($social->facebook): ?>
              <a href="<?php echo e($social->facebook); ?>" class="facebook" target="_blank" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <?php endif; ?>
              <?php if($social->twitter): ?>
              <a href="<?php echo e($social->twitter); ?>" class="twitter" target="_blank" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
              <?php endif; ?>
              <?php if($social->instagram): ?>
              <a href="<?php echo e($social->instagram); ?>" class="instagram" target="_blank" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <?php endif; ?>
              <?php if($social->linkedin): ?>
              <a href="<?php echo e($social->linkedin); ?>" class="linkedin" target="_blank" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
              <?php endif; ?>
              <?php if($social->github): ?>
              <a href="<?php echo e($social->github); ?>" class="github" target="_blank" aria-label="GitHub"><i class="bi bi-github"></i></a>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <form class="search-form ms-4">
            <input type="text" placeholder="Search..." class="form-control" aria-label="Search">
            <button type="submit" class="btn" aria-label="Search Button"><i class="bi bi-search"></i></button>
          </form>
        </div>
      </div>

      <!-- Nav Menu -->
      <div class="nav-wrap">
        <div class="container d-flex justify-content-center position-relative">
          <nav id="navmenu" class="navmenu">
            <ul>
              <li><a href="<?php echo e(url('/')); ?>" class="active">Home</a></li>
              <li><a href="<?php echo e(url('about-me')); ?>">About</a></li>
              <li><a href="<?php echo e(route('posts')); ?>">Laravel Posts</a></li>
              <li><a href="<?php echo e(route('network.show')); ?>">Network Posts</a></li>

              <li class="dropdown">
                <a href="#"><span>Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="<?php echo e(url('about-me')); ?>">About</a></li>
                  <li><a href="<?php echo e(url('category')); ?>">Category</a></li>
                  <li><a href="<?php echo e(route('posts')); ?>">Posts</a></li>
                  <li class="dropdown">
                    <a href="#"><span>More Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                      <li><a href="<?php echo e(url('contact')); ?>">Contact</a></li>
                      <li><a href="<?php echo e(url('about-me')); ?>">About</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="<?php echo e(url('contact')); ?>">Contact</a></li>
            </ul>
            <!-- Mobile Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
        </div>
      </div>

    </div>
  </header>

  <main class="main"><?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/header.blade.php ENDPATH**/ ?>