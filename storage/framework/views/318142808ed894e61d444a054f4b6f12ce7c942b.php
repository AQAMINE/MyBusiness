<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
        <script>
            window.location = "/login";
        </script>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        

        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="card mb-3 bg-light rounded-0 profile_info_card" style="max-width: 100%;">
                <div class="row g-0 ">
                    <div class="col-md-4 ">
                        <img src="<?php echo e(asset('UsersProfilesPictures/' . Auth::user()->profile_pic)); ?>" class="img-fluid "
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body ">
                            <h5 class="card-title"><?php echo e('@' . $data->username); ?> <small
                                    class="text-muted"><?php echo e($data->name); ?>

                                    <?php echo e($data->firstname); ?></small>
                                <?php if($data->approvement == 1): ?>
                                    <span class="approvment text-success">Approved</span>
                                <?php else: ?>
                                    <span class="approvment text-danger">Not approved</span>
                                <?php endif; ?>
                            </h5>
                            <h5><strong class="text-success">Tasks Done: <?php echo e($tasksdone); ?> <i class="fa fa-check"></i></strong> <strong
                                    class="text-danger">Undone Tasks: <?php echo e($undoneTasks); ?> <i class="fa fa-remove"></i></strong></h5>
                            <p class="card-text"><?php echo e($data->role_incompany); ?></p>


                            <div class="card rounded-0 " style="width:100%;">
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item bg-light">+212 <?php echo e($data->phone); ?></li>
                                    <li class="list-group-item bg-light"><?php echo e($data->email); ?></li>
                                    <li class="list-group-item bg-light">
                                        <?php if($data->role == 1): ?>
                                            Admin
                                        <?php elseif($data->role == 2): ?>
                                            Invoice Manager
                                        <?php else: ?>
                                            Employer
                                        <?php endif; ?>
                                    </li>
                                    <li class="list-group-item bg-light"><?php echo e($data->cin); ?></li>
                                </ul>
                            </div>



                            <a href="<?php echo e(route('editeProfile' , Auth::id())); ?>"class="btn btn-dark btn-sm text-light rounded-0 mt-2">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/profile.blade.php ENDPATH**/ ?>