<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
    <script>window.location = "/login";</script>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        <h2 class="mb-4">Notifications</h2>

        <!--Start Notification-->
        <?php $__currentLoopData = $AllNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-dark alert-dismissible fade show rounded-0" role="alert">
            <strong class="text-secondary"><?php echo e($notification->created_at->diffForHumans()); ?> |</strong> <?php echo e($notification->notification); ?>

            <a  class="btn-close delete-notification" data-bs-dismiss="alert" aria-label="Close"></a>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!--End Notification-->

   <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/notifications.blade.php ENDPATH**/ ?>