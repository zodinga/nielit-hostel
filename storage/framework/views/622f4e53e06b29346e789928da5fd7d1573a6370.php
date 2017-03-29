<?php $__env->startSection('title','| Admission'); ?>

<?php $__env->startSection('stylesheets'); ?>
	<?php echo Html::style('css/parsley.css'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-2">
		<h1>Admission</h1>
	</div>
	<div class="col-md-6">
	
				<?php echo Form::open(['route'=>'hms.students.search','method'=>'get','class'=>'navbar-form navbar-left']); ?>

			        <div class="form-group">
			          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Name">
			        </div>
			        <button type="submit" class="btn btn-success form-spacing-top"><i class="fa fa-search" aria-hidden="true"></i></button>
				<?php echo Form::close(); ?>

	</div>
	<div class="col-md-4">
		<a href="<?php echo e(route('hostellers.create')); ?>" class="btn btn-primary btn-lg form-spacing-top">New Admission</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		
		<table class="table">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Course</th>
				<th>Yoj</th>
				<th>Present Address</th>
				<th>Permanent Address</th>
				<th>Photo</th>
				<th>Sex</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php foreach($students as $student): ?>
				<form action="<?php echo e(route('sex.assign')); ?>" method="post">
				<?php echo e(csrf_field()); ?>

					<tr>
						<td><?php echo e($student->id); ?><input type="hidden" name="id" value="<?php echo e($student->id); ?>"></td>
						<td><?php echo e($student->name); ?></td>
						<td><?php echo e($student->course->name); ?></td>
						<td><?php echo e($student->doj); ?></td>
						<td><?php echo e($student->per_street, $student->per_city, $student->per_district, $student->per_state, $student->per_pin); ?></td>
						<td><?php echo e($student->per_street, $student->pre_city, $student->pre_district, $student->pre_state, $student->pre_pin); ?></td>
						<td><img src="<?php echo e($student->image?asset('images/'.$student->image):'/images/question.jpg'); ?>" alt="..." class="img-rounded" height="33" width="28"> </td>
						<td>
							<input type="radio" name="gender" value="M" <?php echo e($student->sex=='M'?'checked':''); ?>> <i class="fa fa-male" aria-hidden="true"></i>
	 						<input type="radio" name="gender" value="F" <?php echo e($student->sex=='F'?'checked':''); ?>> <i class="fa fa-female" aria-hidden="true"></i>
	 						<button type="submit" class="btn btn-success btn-xs">Assign Sex</button>
 						 </td>
						<td>
						<?php if(!$student->hosteller_1 and !$student->hosteller_2): ?>
						<a href="<?php echo e(route('admissions.create',$student->id)); ?>" class="btn btn-warning">Admit</a>
						<?php endif; ?>
						 
						</td>
					</tr>
					</form>
				<?php endforeach; ?>
			</tbody>
		</table>
				<?php echo $students->appends(Request::except('page'))->links(); ?>

	</div>


</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<?php echo Html::script('js/parsley.min.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>