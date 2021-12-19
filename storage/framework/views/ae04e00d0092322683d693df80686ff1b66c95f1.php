<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
    <script>window.location = "/login";</script> 
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        <h2 class="mb-4">Taks</h2>
        <button title="Add new task" type="button" class="add-r-button btn btn-success rounded-0"  data-bs-toggle="modal" data-bs-target="#AddNewTaskModal" ><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
        
        <!--Start Task Toast-->
        <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="toast rounded-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" >
            <div class="toast-header">
            <small class="badge bg-dark text-light">11 mins ago</small>|
            <strong class="me-auto">Task For User</strong>
            </div>
            <div class="toast-body">
            You  Must do  delevery for any new orders
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</button>
                <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveTaskModal">Delete</button>
                <button type="button" class="btn btn-success btn-sm rounded-0" data-bs-dismiss="toast">Done</button>
            </div>
            </div>
        </div>
        </div>


        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="toast rounded-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" >
            <div class="toast-header">
            <small class="badge bg-dark text-light">11 mins ago</small>|
            <strong class="me-auto">Task For User</strong>
            </div>
            <div class="toast-body">
            You  Must do  delevery for any new orders
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</button>
                <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveTaskModal">Delete</button>
                <button type="button" class="btn btn-success btn-sm rounded-0" data-bs-dismiss="toast">Done</button>
            </div>
            </div>
        </div>
        </div>


        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="toast rounded-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" >
            <div class="toast-header">
            <small class="badge bg-dark text-light">11 mins ago</small>|
            <strong class="me-auto">Task For User</strong>
            </div>
            <div class="toast-body">
            You  Must do  delevery for any new orders
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</button>
                <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveTaskModal">Delete</button>
                <button type="button" class="btn btn-success btn-sm rounded-0" data-bs-dismiss="toast">Done</button>
            </div>
            </div>
        </div>
        </div>


        <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="toast rounded-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" >
            <div class="toast-header">
            <small class="badge bg-dark text-light">11 mins ago</small>|
            <strong class="me-auto">Task For User</strong>
            </div>
            <div class="toast-body">
            You  Must do  delevery for any new orders
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</button>
                <button type="button" class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveTaskModal">Delete</button>
                <button type="button" class="btn btn-success btn-sm rounded-0" data-bs-dismiss="toast">Done</button>
            </div>
            </div>
        </div>
        </div>
        
        



        </div>

        
        <!--End Task Toast--->

        <!--Start Taks Done-->
        <section class="taks-done">
        <h5 class="text-center">Tasks Done</h5>
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">Task For User</th>
                <th scope="col">Taks Title</th>
                <th scope="col">Task</th>
                <th scope="col">Create Date</th>
                <th scope="col">Done Date</th>
                <th scope="col">Undone</th>
                <th scope="col">Remove</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">aqamine</th>
                <td>delevery</td>
                <td class="text-truncate" style="max-width: 200px;">you  must deleveryall product you  must deleveryall product you  must deleveryall product you  must deleveryall product you  must deleveryall product you  must deleveryall product...</td>
                <td>12/12/2021</td>
                <td>13/12/2021</td>
                <td><a href="#"  class="btn btn-warning btn-sm rounded-0">Undone</a></td>
                <td><a href="#" class="btn btn-danger btn-sm  rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveTaskModal">Remove</a></td>
            </tr>
            
            </tbody>
        </table>
        </section>
        <!--End Taks Done-->
        <!--Start Edit Tasks Modal-->
        <div class="modal fade" id="EditTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
            <div class="modal-content rounded-0">
                <div class="modal-header bg-success  rounded-0">
                <h5 class="modal-title" id="EditTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <div class="form-floating">
                    <select class="form-select" id="floatingSelectEditTask" name="foruser" aria-label="Floating label select example">
                        <option selected>Select  User</option>
                        <option value="0">Public Task</option>
                        <?php $__currentLoopData = $usersFullNameAndIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usersFullNameAndId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($usersFullNameAndId->id); ?>"><?php echo e($usersFullNameAndId->firstname); ?> <?php echo e($usersFullNameAndId->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label for="floatingSelectEditTask">For users have an approved account</label>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" name="tasktitle" class="form-control rounded-0" placeholder="Task Title" value="delevery">
                </div>
                
                <div class="mb-3">
                    <textarea class="form-control rounded-0" name="taskcontent" placeholder="Type Task Here!">you must do delevery forallpending orders</textarea>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-sm rounded-0">Edit Task</button>
                </div>
            </div>
            </form>
        </div>
        </div>
        <!--End Edit Tasks Modal-->
        <!--Start New Tasks Modal-->
        <div class="modal fade" id="AddNewTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddNewTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo e(route('tasks.store')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

            <div class="modal-content rounded-0">
                <div class="modal-header bg-success  rounded-0">
                <h5 class="modal-title" id="AddNewTaskModalLabel">Add  New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <div class="form-floating">
                    <select class="form-select" id="floatingSelectAddTask" name="privacy" aria-label="Floating label select example">
                        <option selected>Select  User</option>
                        <option value="0">Public Task</option>
                        <?php $__currentLoopData = $usersFullNameAndIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usersFullNameAndId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($usersFullNameAndId->id); ?>"><?php echo e($usersFullNameAndId->firstname); ?> <?php echo e($usersFullNameAndId->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label for="floatingSelectAddTask">For users have an approved account</label>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" name="taskTitle" class="form-control rounded-0" placeholder="Task Title">
                </div>
                
                <div class="mb-3">
                    <textarea class="form-control rounded-0" name="task" placeholder="Type Task Here!"></textarea>
                </div>
                </div>
                <div class="modal-footer">
                <a  class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                <button type="submit" class="btn btn-success btn-sm rounded-0">Add Task</button>
                </div>
            </div>
            </form>
        </div>
        </div>
        <!--End New Tasks Modal-->

        <!--Start Remove Tasks Modal-->
        <div class="modal fade" id="RemoveTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RemoveTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form action="">
                <div class="modal-content rounded-0">
                <div class="modal-header bg-danger  rounded-0">
                    <h5 class="modal-title" id="RemoveTaskModalLabel">Warning!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sure you want to remove this task!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm rounded-0">Remove Task</button>
                </div>
                </div>
            </form>
            </div>
        </div>
        <!--End Remove Tasks Modal-->
   <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/tasks.blade.php ENDPATH**/ ?>