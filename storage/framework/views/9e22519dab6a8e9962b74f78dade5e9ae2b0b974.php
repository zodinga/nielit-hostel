<?php $__env->startSection('title','| Reports'); ?>
<?php $__env->startSection('stylesheets'); ?>
	<?php echo Html::style('css/parsley.css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">

 	<div class="col-md-3">
	   <a href="<?php echo e(route('reports.custom')); ?>" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Custom <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

 	<div class="col-md-3">
	   <a href="<?php echo e(route('reports.custom')); ?>" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Pending Mess <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

 	<div class="col-md-3">
	   <a href="<?php echo e(route('reports.custom')); ?>" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Boys <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

 	<div class="col-md-3">
	   <a href="<?php echo e(route('reports.custom')); ?>" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Girls <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

</div>		
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<?php echo Html::script('js/parsley.min.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>