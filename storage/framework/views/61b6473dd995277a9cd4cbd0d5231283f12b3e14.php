<?php $__env->startSection('title','| Homepage'); ?>
    
<?php $__env->startSection('content'); ?>
    Main page      
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>