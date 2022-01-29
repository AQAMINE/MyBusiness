<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/sidebar.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main-drk.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">

        
        <?php if(auth()->guard()->check()): ?>
            <?php echo $__env->make('layouts.sidebare', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">

            <!--Start Content choice-->
            <?php echo $__env->yieldContent('content'); ?>
            <!--End Content choice-->

            <?php if(auth()->guard()->check()): ?>
                <!--Start change profile picture Modal-->
                <div class="modal fade" id="changeProfilePictureModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="changeProfilePictureModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?php echo e(route('EditProfilePicture')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="modal-content rounded-0">
                                <div class="modal-header bg-dark rounded-0">
                                    <h5 class="modal-title text-white" id="changeProfilePictureModalLabel">Change profile
                                        picture</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">

                                        <label for="profile_pic" class="form-label">Open or drag your picture
                                            here</label>
                                        <input type="file" class="form-control" id="profile_pic" name="profile_pic">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-secondary btn-sm rounded-0 text-light"
                                        data-bs-dismiss="modal">Cancel</a>
                                    <button type="submit" class="btn btn-success btn-sm rounded-0">Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--End change profile picture Modal-->

                <!--Start Logout Modal-->
                <div class="modal fade" id="LogoutModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="LogoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog">

                        <div class="modal-content rounded-0">
                            <div class="modal-header bg-secondary  rounded-0">
                                <h5 class="modal-title" id="LogoutModalLabel">Confirmation!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Sure you want to <strong>Sign Out?</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm rounded-0"
                                    data-bs-dismiss="modal">Cancel</button>


                                <a class="btn btn-info btn-sm rounded-0" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                    class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
                <!--End Logout Modal-->
            <?php endif; ?>
            <footer>Copyright 2019 2021 all rights reserved|AQAMINE DEVELOPER</footer>
        </div>
    </div>



    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/main.js')); ?>" defer></script>
    <!--***************************************************Old Page End****************************************-->

</body>

</html>
<?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/layouts/app.blade.php ENDPATH**/ ?>