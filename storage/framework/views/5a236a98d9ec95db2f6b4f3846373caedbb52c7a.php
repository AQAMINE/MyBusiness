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


                <nav id="sidebar">
                    <div class="custom-menu">
                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                </button>
            </div>
                <div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
                    <div class="user-logo">
                        <div class="img  "style="background-image: url(images/logo.jpg);" data-bs-target="#changeProfilePictureModal" data-bs-toggle="modal"> <div class="img blacks" data-bs-target="#changeProfilePictureModal" data-bs-toggle="modal"><a class="Link_call_Modal_PDP" href="#" data-bs-target="#changeProfilePictureModal" data-bs-toggle="modal"><small>Change</small></a></div></div>
                        <h3><?php echo e(Auth::user()->name." ".Auth::user()->firstname); ?></h3>
                    </div>
                </div>
            <ul class="list-unstyled components mb-5">
            <li <?php if(Request::route()->getName() == 'home'): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('home')); ?>"><span class="fa fa-home mr-3"></span> Home</a>
            </li>
            <li>
                <a href="<?php echo e(route('notifications.index')); ?>"><span class="fa fa-bell mr-3 notif"><small class="d-flex align-items-center justify-content-center">5</small></span> Notifications</a>
            </li>
            <li>
                <a href="analytics.html"><span class="fa fa-bar-chart mr-3"></span> Analytics</a>
            </li>

            <li <?php if(Request::route()->getName() == 'tasks.index'): ?> class="active" <?php endif; ?> >
                <a href="<?php echo e(route('tasks.index')); ?>"><span class="fa fa-tasks mr-3"></span> Tasks</a>
            </li>

             <!--Start Check If  User Admin Or Invoice/Clients Manager-->
                <?php if(Auth::user()->approvement == 1  && (Auth::user()->role == 1) or (Auth::user()->role == 2)): ?>
                <li>
                    <a href="invoices.html"><span class="fa fa-file-excel-o mr-3"></span> Invoices</a>
                </li>
                <li>
                    <a href="clients.html"><span class="fa fa-users mr-3"></span> Clients</a>
                </li>
                <?php endif; ?>
            <!--End Check If  User Admin Or Invoice/Clients Manager-->

            <li>
                <a href="usersmanager.html"><span class="fa fa-address-book mr-3"></span> Users Manager</a>
            </li>
            <li>
                <a href="profile.html"><span class="fa fa-user mr-3"></span> Profile</a>
            </li>
            <li>
                <a href="settings.html"><span class="fa fa-cog mr-3"></span> Settings</a>
            </li>
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#LogoutModal"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
            </li>
            </ul>

            </nav>

    <?php endif; ?>
    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">


    <!--Start Content choice-->
    <?php echo $__env->yieldContent('content'); ?>
     <!--End Content choice-->


     <?php if(auth()->guard()->check()): ?>
            <!--Start change profile picture Modal-->
            <div class="modal fade" id="changeProfilePictureModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeProfilePictureModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form action="">
                    <div class="modal-content rounded-0">
                    <div class="modal-header bg-dark rounded-0">
                        <h5 class="modal-title text-white" id="changeProfilePictureModalLabel">Change profile picture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="profilepicture" class="form-label">Open or drag your picture here</label>
                            <input class="form-control" type="file" id="profilepicture" name="profilepicture">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success btn-sm rounded-0">Change</button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            <!--End change profile picture Modal-->

                  <!--Start Logout Modal-->
                  <div class="modal fade" id="LogoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="LogoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog">

                        <div class="modal-content rounded-0">
                            <div class="modal-header bg-secondary  rounded-0">
                            <h5 class="modal-title" id="LogoutModalLabel">Confirmation!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Sure you want to <strong>Sign Out?</strong>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>


                            <a  class="btn btn-info btn-sm rounded-0" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <?php echo e(__('Logout')); ?>

                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
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