<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>News <i class="fa fa-newspaper-o"></i></h1>
                <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card text-white bg-dark mb-3 rounded-0">
                    <div class="card-header">
                        <small class="badge bg-primary text-light">By: <?php echo e($ad->user->name); ?> <?php echo e($ad->user->firstname); ?></small>
                        <small class="badge bg-light text-dark"><?php echo e($ad->created_at->diffForHumans()); ?></small>
                    </div>

                    <div class="card-body">
                        <!--<h5 class="card-title">Info card title</h5>-->
                        <p class="card-text"><?php echo e($ad->content); ?></p>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/home.blade.php ENDPATH**/ ?>