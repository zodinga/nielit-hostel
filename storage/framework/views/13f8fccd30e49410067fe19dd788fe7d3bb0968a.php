<?php $__env->startSection('title','| Reports'); ?>
<?php $__env->startSection('stylesheets'); ?>
	<?php echo Html::style('css/parsley.css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

	<div class="row">
		<div class="col-md-3">
			<h1>Custom Report</h1>
		</div>
		<div class="col-md-3">
			<?php echo Form::open(['route'=>'reports.custom','data-parsley-validate'=>'','method'=>'post']); ?>

			<?php echo e(Form::text('h_name',null,['class'=>'form-control','placeholder'=>'Name'])); ?>

			<?php echo e(Form::select('h_course_id', $courses ,null,['class'=>'form-control','placeholder' => 'Pick a course...'])); ?>

			<?php echo e(Form::select('sex', ['Boys','Girls'] ,null,['class'=>'form-control','placeholder' => 'Pick a gender...'])); ?>

		</div>
		<div class="col-md-3">
			<table class="table table-bordered">
			<thead>
				<th>Field Name</th>
				<th><?php echo e(Form::checkbox('select_all',null,null,['id'=>'checkAll'])); ?> Select All</th>
			</thead>
			<?php foreach($hosteller_table as $table): ?>
			<tr>
				<td class="text-success"><?php echo e(Form::label($table)); ?></td>
				<td><?php echo e(Form::checkbox($table,null,null,['class'=>'chk'])); ?></td>
			</tr>	
			<?php endforeach; ?>
			</table>
		</div>
		<div class="col-md-3">
				<input type="image" src="/images/excel.png" alt="Submit" width="80">
				
			<?php echo Form::close(); ?>

		</div>
	</div>		
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<?php echo Html::script('js/parsley.min.js'); ?>

	<script>
		$(document).ready( function ()
		{
			$('#checkAll').change(function () {
			    $('.chk').prop('checked', this.checked);
			});

			$(".chk").change(function () {
		    if ($(".chk:checked").length == $(".chk").length) {
		        $('#checkAll').prop('checked', 'checked');
		    } else {
		        $('#checkAll').prop('checked', false);
		    }
		});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>