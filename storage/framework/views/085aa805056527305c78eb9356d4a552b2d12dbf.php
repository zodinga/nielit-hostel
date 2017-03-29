<?php $__env->startSection('title','| Admit'); ?>

<?php $__env->startSection('stylesheet'); ?>
	<?php echo Html::style('css/parsley.css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-6">
			<table class="table table-bordered">
			<caption>Boys</caption>
				<thead>
					<th>Floor</th>
					<th>Room</th>
					<th class="text-center">Bed 1</th>
					<th class="text-center">Bed 2</th>
				</thead>
				<tbody>
					<?php foreach($rooms as $room): ?>
					<tr>
						<td><?php echo e($room->floor); ?></td>
						<td><?php echo e($room->room_no); ?></td>
						<td><?php echo e($room->hosteller_1['name']); ?></td>
						<td><?php echo e($room->hosteller_2['name']); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		
		<div class="col-md-3">
			<div class="well" style="background-color: #ff4d4d;">
				<?php echo Form::open(['route'=>'hostellers.store','data-parsley-validate'=>'','method'=>'POST']); ?>

					<h2>New Admission</h2>
					<?php echo e(Form::label('building')); ?>

					<?php echo e(Form::select('building', ['Boys'=>'Boys', 'Girls'=>'Girls'], null, ['id'=>'building','placeholder' => 'Pick a building...','class'=>'form-control','autofocus','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('room')); ?>

					<?php echo e(Form::select('room', $room_vacant, null, ['id'=>'room','placeholder' => 'Pick a room...','class'=>'form-control','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('name')); ?>

					<?php echo e(Form::text('name',null,['class'=>'form-control','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('course_id','Course')); ?>

					<?php echo e(Form::select('course_id', $courses, null, ['id'=>'room','placeholder' => 'Pick a course...','class'=>'form-control','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('phone')); ?>

					<?php echo e(Form::text('phone',null,['class'=>'form-control','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('guardian')); ?>

					<?php echo e(Form::text('guardian',null,['class'=>'form-control','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('guardian_phone')); ?>

					<?php echo e(Form::text('guardian_phone',null,['class'=>'form-control','data-parsley-required'=>''])); ?>


					<?php echo e(Form::label('admission_date')); ?>

					<?php echo e(Form::date('admission_date',null,['class'=>'form-control','data-parsley-required'=>''])); ?>

					
					<?php echo e(Form::label('remarks')); ?>

					<?php echo e(Form::text('remarks',null,['class'=>'form-control'])); ?>

					
					<?php echo e(Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])); ?>

				<?php echo Form::close(); ?>

			</div>
		</div>
		
		<div class="col-md-3">
			<table class="table table-bordered">
			<caption>Girls</caption>
				<thead>
					<th>Floor</th>
					<th>Room</th>
					<th class="text-center">Bed</th>
				</thead>
				<tbody>
					<?php foreach($grooms as $groom): ?>
					<tr>
						<td><?php echo e($groom->floor); ?></td>
						<td><?php echo e($groom->room_no); ?></td>
						<td><?php echo e($groom->hosteller_1['name']); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<?php echo Html::script('js/parsley.min.js'); ?>

	<script>
		$(document).ready( function ()
		{
			$('#building').change(function(){
				var id = this.value;
				//alert(id);
				$("#room").empty();
				$.get('/ajax-room?id='+id,function(data){
					$.each(data, function (i, dat) {
					   $("#room").append("<option value='"+dat.id+"'>" + dat.room_no + "</option>");
					});

				});
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>