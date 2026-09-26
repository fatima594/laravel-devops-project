<?php $__env->startSection('header'); ?>
<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('headerpost'); ?>
<?php echo $__env->make('layouts.headerpost', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldSection(); ?>

   <!-- /Blog Hero Section -->

    <!-- Featured Posts Section -->
    <?php $__env->startSection('featurepost'); ?>
    <?php echo $__env->make('layouts.featurepost', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
   <?php echo $__env->yieldSection(); ?>
    <!-- /Featured Posts Section -->

    <!-- Category Section Section -->

   <?php $__env->startSection('categoryhome'); ?>
    <?php echo $__env->make('layouts.categoryhome', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
   <?php echo $__env->yieldSection(); ?>



    <?php $__env->startSection('calltoaction'); ?>
    <?php echo $__env->make('layouts.calltoaction', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
   <?php echo $__env->yieldSection(); ?>


    <!-- Latest Posts Section -->
    <?php $__env->startSection('latestpost'); ?>
    <?php echo $__env->make('layouts.latestpost', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldSection(); ?>
    <!-- /Latest Posts Section -->

    <!-- Call To Action Section -->
     <?php $__env->startSection('subscriber'); ?>
    <?php echo $__env->make('layouts.subscriber', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldSection(); ?>
  <!-- /Call To Action Section -->


 <?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldSection(); ?>
<?php /**PATH C:\xampp\htdocs\divopsproject\laravelblog\laravelblog\resources\views/layouts/master.blade.php ENDPATH**/ ?>