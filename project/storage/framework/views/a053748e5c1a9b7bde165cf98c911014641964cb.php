<?php $__env->startSection('title'); ?>
	Publishers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/publisher/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
           <li><a href="<?php echo e(url('/publisher/publishers')); ?>">Publisher Overview</a></li>
           <li class="active">Edit Publisher</li>
        </ol>
    </div>
    <!-- /top tiles -->

    
    <div class="row">
        <h3>Add Publisher</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
				<div class="x_title tab_on">
					<a class="btn btn-primary" href="">Configuration</a>
					<a class="btn btn-default"  href="">Ad Positions</a>
					<a class="btn btn-primary" href="">Custom</a>
				</div>
            <div class="x_content"><br />
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <form action="<?php echo e(url('/publisher/add-positions')); ?>" method="post" class="form-label-left">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                     <input type="hidden" name="publisherId" value="<?php echo e($publisherId); ?>">
                    <?php echo $__env->make('publisher.add_form',['submitButtonText' => 'Submit'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </form>
            </div>
        </div>
      </div>
    </div>
    
<?php $__env->stopSection(); ?>  

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$(document).ready(function()
{
  $("#add_targeting").click(function(){
	
	$(".target_main").append('<div class="target_sub"><div class="form-group"><div class="col-md-3 col-sm-3 col-xs-6"><input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value=""></div><div class="col-md-3 col-sm-3 col-xs-6"><input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value=""></div></div></div>');
	});
	
	$(".mobile").click(function(){
        if($(this).val()=='default'){
            $(".mobile_sizes").val('');
            $(".mobile_sizes").attr('readonly',true);

        }else{
            $(".mobile_sizes").val('');
            $(".mobile_sizes").attr('readonly',false);
        }
	});
    $(".tablet").click(function(){
       if($(this).val()=='default'){
            $(".tablet_sizes").val('');
            $(".tablet_sizes").attr('readonly',true);
        }else{
            $(".tablet_sizes").val('');
            $(".tablet_sizes").attr('readonly',false);
        }
    });
    $(".desktop").click(function(){
       if($(this).val()=='default'){
            $(".desktop_sizes").val('');
            $(".desktop_sizes").attr('readonly',true);
        }else{
            $(".desktop_sizes").val('');
            $(".desktop_sizes").attr('readonly',false);
        }
    });
	$("#delete_targeting").click(function(){
		$('.target_main div.target_sub:last').remove();
	});
}); 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>