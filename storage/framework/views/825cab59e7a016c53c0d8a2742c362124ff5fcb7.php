<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
    <script>window.location = "/login";</script>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        <h2 class="mb-4">Notifications</h2>

        <!--Start Notification-->
        <?php if($AllNotifications->isEmpty()): ?>
            <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> You Don't Have Any Notification To Show</h5>
        <?php else: ?>
            <?php $__currentLoopData = $AllNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-dark alert-dismissible fade show rounded-0" role="alert">
                <strong class="text-secondary"><?php echo e($notification->created_at->diffForHumans()); ?> |</strong> <?php echo e($notification->notification); ?>


                <form action="<?php echo e(Route('notifications.destroy', $notification->id)); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button  class="btn-close delete-notification" ></button>
                </form>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>


        <!--End Notification-->

   <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/notifications.blade.php ENDPATH**/ ?>