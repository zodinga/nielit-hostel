<?php $__env->startSection('title','| Hosteller'); ?>

<?php $__env->startSection('stylesheet'); ?>
	<?php echo Html::style('css/parsley.css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<ul class="list-group">
		  <li class="list-group-item list-group-item-success"><b>HOSTEL ID: </b><?php echo e($hosteller->id); ?></li>
		  <li class="list-group-item list-group-item-info"><b>NAME: </b><?php echo e($hosteller->name); ?></li>
		  <li class="list-group-item list-group-item-warning"><b>COURSE: </b><?php echo e($hosteller->course->name); ?></li>
		  <li class="list-group-item list-group-item-danger"><b>PHONE: </b><?php echo e($hosteller->phone); ?></li>
		  <li class="list-group-item list-group-item-success"><b>GUARDIAN: </b><?php echo e($hosteller->guardian); ?></li>
		  <li class="list-group-item list-group-item-info"><b>GUARDIAN PHONE: </b><?php echo e($hosteller->guardian_phone); ?></li>
		  <li class="list-group-item list-group-item-success"><b>ADMIT DATE: </b><?php echo e($hosteller->admission_date); ?></li>
		</ul>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<?php echo Html::script('js/parsley.min.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>