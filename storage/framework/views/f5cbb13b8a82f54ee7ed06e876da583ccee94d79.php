<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">


                <div class="card-body login-page">
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div  class="row mb-4 mt-2 text-center login-logo"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
                        <div class="row mb-3">


                                <input id="email" type="email" class="form-control rounded-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('E-Mail Address')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>

                        <div class="row mb-3">


                                <input id="password" type="password" class="form-control rounded-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" placeholder="<?php echo e(__('Password')); ?>" required autocomplete="current-password">

                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="row mb-3 mt-2">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input rounded-0" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label" for="remember">
                                      <small class="text-secondary"> <?php echo e(__('Remember Me')); ?></small>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-dark rounded-0 btn-block">
                                    <?php echo e(__('Login')); ?>

                                </button>
                                <a class="btn btn-success rounded-0 btn-block" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>

                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link link-secondary" href="<?php echo e(route('password.request')); ?>">
                                       <small> <?php echo e(__('Forgot Your Password?')); ?></small>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/auth/login.blade.php ENDPATH**/ ?>