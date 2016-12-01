<?php $__env->startSection('title'); ?>
	Publishers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php /* */use App\Repositories\CommonRepositoryInterface;/* */ ?>
<?php /* */use App\Repositories\CommonRepository;/* */ ?>
    
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
        <h3>Ad Positions</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <a class="btn btn-primary" style="float:right;" href="<?php echo e(url('/publisher/add-positions/'.$publisherId)); ?>">NEW ADSLOT</a>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Slotname</th>
                                <th>Notices</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($positions as $position): ?>
                                <tr>
                                    <td><?php echo e($position->slotname); ?></td>
                                    <td>6</td>
                                    <?php   /*if($position->status == 1) { $position_status = 'Live'; }
                                            else if($position->status == 2) { $position_status = 'Paused'; }
                                            else if($position->status == 3) { $position_status = 'Suspended'; }
                                    
                                    */?>
                                    <td><?php echo e($position->status); ?></td>
                                    <td><a class="btn btn-primary" href="<?php echo e(CommonRepository::encryptId($position->id)); ?>">Edit</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    
<?php $__env->stopSection(); ?>  


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>