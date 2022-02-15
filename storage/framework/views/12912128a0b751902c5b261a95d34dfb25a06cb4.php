<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
        <script>
            window.location = "/login";
        </script>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        
        <div class="container">
            <div class="row information-update-zone bg-dark">
                <div class="col-lg-8 col-md-8 col-sm-12 ">
                    <form action="<?php echo e(route('user.update', $datas->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" value="PUT">
                        <table class="table table-dark">

                            <tr>

                                <th scope="row">UserName</th>
                                <td><input type="text" class="form-control-plaintext form-control-dark-mode" name="username"
                                        value="<?php echo e($datas->username); ?>" placeholder=""></td>
                            </tr>

                            <tr>
                                <th scope="row">First Name</th>
                                <td><input type="text" class="form-control-plaintext form-control-dark-mode" name="firstname"
                                        value="<?php echo e($datas->firstname); ?>"></td>
                            </tr>

                            <tr>
                                <th scope="row">Last Name</th>
                                <td><input type="text" class="form-control-plaintext form-control-dark-mode" name="lastname"
                                        value="<?php echo e($datas->name); ?>"></td>
                            </tr>

                            <tr>
                                <th scope="row">Phone Number</th>
                                <td><input type="tel" class="form-control-plaintext form-control-dark-mode" name="phone"
                                        value="<?php echo e($datas->phone); ?>"></td>
                            </tr>


                            <tr>
                                <th scope="row">CIN</th>
                                <td><input type="text" class="form-control-plaintext form-control-dark-mode" name="cin"
                                        value="<?php echo e($datas->cin); ?>"></td>
                            </tr>

                            <tr>
                                <th scope="row">Id Card</th>
                                <td>
                                    <input type="file" name="id_card" placeholder="Reploaded" class="form-control-plaintext form-control-dark-mode">


                                    <?php if(is_null($datas->id_card)): ?>
                                        <span class="badge bg-danger">Not Uploaded</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Uploaded</span>
                                    <?php endif; ?>

                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Approvement</th>
                                <td>
                                    <?php if($datas->approvement == 1): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Not approved</span>
                                    <?php endif; ?>

                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Joined Date</th>
                                <td><?php echo e($datas->created_at); ?></td>
                            </tr>

                            <tr>
                                <th scope="row">Role In company</th>
                                <td><textarea name="role_in_company"
                                        class="form-control-plaintext form-control-dark-mode rounded-0"><?php echo e($datas->role_incompany); ?></textarea>
                                </td>
                            </tr>

                        </table>
                        <button type="submit" class="btn btn-success rounded-0">Save Change</button>
                    </form>

                </div>
                <!--Start Profile Picture Update Card-->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card bg-dark text-light">
                        <img src="<?php echo e(asset('UsersProfilesPictures/' . Auth::user()->profile_pic)); ?>" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-light">Profile Picture</h5>
                            <p class="card-text">you must upload professional profile picture</p>
                            <a href="#" class="btn btn-info rounded-0" data-bs-target="#changeProfilePictureModal"
                                data-bs-toggle="modal">Change profile picture</a>
                        </div>
                    </div>
                </div>
                <!--End Profile Picture Update Card-->


            </div>
        </div>
        <!--End Profile  Content-->
        <!--Start Button Grid-->
        <section class="btn-profile-update">
            <div class="row row-cols-auto">

                <div class="col ps-3 px-0">
                    <button class="btn btn-info rounded-0" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change
                        Password</button>
                </div>
                <div class="col px-1">
                    <button class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveuserModal">Delete
                        Account</button>
                </div>


            </div>
        </section>
        <!--End Button Grid-->

        <!--Start Remove user Modal-->
        <div class="modal fade" id="RemoveuserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="RemoveuserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo e(route('close.account', $datas->id)); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                            <h5 class="modal-title" id="RemoveuserModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>All invoices created by this account will be <strong>Deleted</strong></li>
                                <li>All clients created by this account will be <strong>Deleted</strong></li>
                                <li>Sure you want to <strong>Close</strong> this account?</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger btn-sm rounded-0">Delete Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove user Modal-->




        <!--Start change password Modal-->
        <div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-info  rounded-0">
                            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <input class="form-control rounded-0" type="password" name="oldpassword"
                                    placeholder="Old Password" />
                            </div>
                            <div class="row g-3">
                                <div class="col">
                                    <input type="password" class="form-control rounded-0" name="password1"
                                        placeholder="New Password" aria-label="New Password">
                                </div>
                                <div class="col">
                                    <input type="password" class="form-control rounded-0" name="password2"
                                        placeholder="Repeat password" aria-label="Repeat password">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded-0"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-info btn-sm rounded-0">Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End change password Modal-->
        </div>
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/profileUpdate.blade.php ENDPATH**/ ?>