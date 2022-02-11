<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
        <script>
            window.location = "/login";
        </script>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        <h2 class="mb-4">Notifications</h2>

        <!--Start Notification-->
        <?php if($AllNotifications->isEmpty()): ?>
            <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> You
                Don't Have Any Notification To Show</h5>
        <?php else: ?>
            <a href="#" class="btn btn-secondary btn-sm rounded-0 mb-2" data-bs-target="#CleareNotificationModal"
                data-bs-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true"></i>
                Clear All Notification</a>
            <?php $__currentLoopData = $AllNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-dark alert-dismissible fade show rounded-0" role="alert">
                    <strong class="text-secondary"><?php echo e($notification->created_at->diffForHumans()); ?> |</strong>
                    <?php echo e($notification->notification); ?>


                    <form action="<?php echo e(Route('notifications.destroy', $notification->id)); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn-close delete-notification"></button>
                    </form>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        
        <!--Start Remove user Modal-->
        <div class="modal fade" id="CleareNotificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="CleareNotificationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo e(route('clearNotifications')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>


                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                            <h5 class="modal-title" id="CleareNotificationModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>Sure you want to cleare all your <strong>Notifications!</strong></li>

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal"><i
                                    class="fa fa-remove"></i> Cancel</a>
                            <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash"></i>
                                Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove user Modal-->
        
        <!--End Notification-->

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/notifications.blade.php ENDPATH**/ ?>