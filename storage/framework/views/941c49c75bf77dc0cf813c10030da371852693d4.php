<?php $__env->startSection('title','| Rooms'); ?>

<?php $__env->startSection('stylesheet'); ?>
	<?php echo Html::style('css/parsley.css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-md-9">
			<h1>Rooms</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Building</th>
						<th>Floor</th>
						<th>Room</th>
						<th>Beds</th>
						<th>Hosteller 1</th>
						<th>Hosteller 2</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($rooms as $room): ?>
					<tr>
						<td><?php echo e($room->id); ?></td>
						<td><?php echo e($room->building); ?></td>
						<td><?php echo e($room->floor); ?></td>
						<td><?php echo e($room->room_no); ?></td>
						<td><?php echo e($room->beds); ?></td>
						<td>
							<?php if($room->hosteller_1): ?>
								<a href="<?php echo e(route('hostellers.show',$room->hosteller_1->id)); ?>"><?php echo e($room->hosteller_1->name); ?></a>
							<?php else: ?>
								<b>---</b>
							<?php endif; ?>
						</td>
						<td>
							<?php if($room->hosteller_2): ?>
								<a href="<?php echo e(route('hostellers.show',$room->hosteller_2->id)); ?>"><?php echo e($room->hosteller_2->name); ?></a>
							<?php else: ?>
								<b>---</b>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				<?php echo Form::open(['route'=>'rooms.store','data-parsley-validate'=>'','method'=>'POST']); ?>

					<h2>New Room</h2>
					<?php echo e(Form::label('building')); ?>

					<?php echo e(Form::select('building', ['Boys'=>'Boys', 'Girls'=>'Girls'], null, ['placeholder' => 'Pick a building...','class'=>'form-control','autofocus','required'=>''])); ?>


					<?php echo e(Form::label('floor')); ?>

					<?php echo e(Form::text('floor',null,['class'=>'form-control','required'=>''])); ?>


					<?php echo e(Form::label('room_no')); ?>

					<?php echo e(Form::text('room_no',null,['class'=>'form-control','required'=>''])); ?>


					<?php echo e(Form::label('beds')); ?>

					<?php echo e(Form::text('beds',null,['class'=>'form-control','required'=>''])); ?>

					
					<?php echo e(Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])); ?>

				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<?php echo Html::script('js/parsley.min.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>