<?php if($errors->any()): ?>
    <?php $errors = $errors; ?>
	<div class="alert alert-danger errorAlertMsgMain text-left">
		<!--a class="close"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a-->
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<strong>Whoops!</strong> There were some problems with your input.
		<ul class="errorAlertMsg">
			<?php foreach($errors->all() as $error): ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else: ?> 
    <?php $errors = []; ?>
<?php endif; ?>