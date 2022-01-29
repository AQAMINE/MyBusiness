<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->guest()): ?>
        <script>
            window.location = "/login";
        </script>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
        <h2 class="mb-4">Taks</h2>
        <?php if(Auth::user()->approvement == 1 && Auth::user()->role == 1): ?>
            <button title="Add new task" type="button" class="add-r-button btn btn-success rounded-0" data-bs-toggle="modal"
                data-bs-target="#AddNewTaskModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
        <?php endif; ?>
        <!--Start Task Toast-->
        <div class="row">

            <?php if($tasks->isEmpty()): ?>
                <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> All
                    <strong>Tasks</strong> Done</h5>
            <?php else: ?>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($task->done == 0): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="toast rounded-0 fade show" role="alert" aria-live="assertive" aria-atomic="true"
                                data-autohide="false">
                                <div class="toast-header">
                                    <small class="badge bg-dark text-light"><?php echo e($task->created_at->diffForHumans()); ?></small>|
                                    <strong class="me-auto">
                                        <!--Strat if user is admin show here task for user (user firstname and last name) if a normal user show here task aded by admin fullname-->
                                        <?php if(Auth::user()->role == 1): ?>
                                            <?php $__currentLoopData = $usersFullNameAndIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($info->id == $task->privacy): ?>
                                                    <?php echo e($info->firstname); ?> <?php echo e($info->name); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?> <?php echo e($task->user->firstname); ?> <?php echo e($task->user->name); ?>

                                    </strong>
                    <?php endif; ?> </strong>
                    <!--End if user is admin show here task for user (user firstname and last name) if a normal user show here task aded by admin fullname-->
                    <strong><?php echo e($task->taskTitle); ?></strong>
        </div>
        <div class="toast-body">
            <?php echo e($task->task); ?>

            <div class="mt-2 pt-2 border-top">
                <!--Admin can remove/Edit task-->
                <?php if(Auth::user()->approvement == 1 && Auth::user()->role == 1): ?>
                    <a onclick="EditTask(<?php echo e($task->id); ?>,<?php echo e($task->privacy); ?>,'<?php echo e($task->taskTitle); ?>','<?php echo e($task->task); ?>')"
                        class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</a>

                    <form action="<?php echo e(Route('tasks.destroy', $task->id)); ?>" method="POST" style="display: inline-block">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" onclick="return confirm('Sure you want to remove this task?','Warning!')"
                            class="btn btn-danger btn-sm rounded-0 text-light">Delete</button>
                    </form>
                <?php endif; ?>
                <a href="<?php echo e(route('TaskDone', $task->id)); ?>" class="btn btn-success btn-sm rounded-0 text-light">Done</a>
            </div>
        </div>
        </div>
        </div>

        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>








        </div>


        <!--End Task Toast--->

        <!--Start Taks Done-->
        <section class="taks-done">
            <h5 class="text-center">Tasks Done</h5>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Creted By</th>
                        <th scope="col">Taks Title</th>
                        <th scope="col">Task</th>
                        <th scope="col">Create Date</th>
                        <th scope="col">Done Date</th>
                        <!--Start Show Task For User If Session Admin-->
                        <?php if(Auth::user()->role == 1): ?>
                            <th scope="col">Task For User</th>
                        <?php endif; ?>
                        <!--End Show Task For User If Session Admin-->
                        <th scope="col">Undone</th>
                        <!--Admin can remove task-->
                        <?php if(Auth::user()->approvement == 1 && Auth::user()->role == 1): ?>
                            <th scope="col">Remove</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskdone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($taskdone->done == 1): ?>
                            <tr>
                                <th scope="row"><?php echo e($taskdone->user->firstname); ?> <?php echo e($taskdone->user->name); ?></th>
                                <td><?php echo e($taskdone->taskTitle); ?></td>
                                <td class="text-truncate" style="max-width: 200px;"><?php echo e($taskdone->task); ?></td>
                                <td><?php echo e($taskdone->created_at); ?></td>
                                <td><?php echo e($taskdone->updated_at); ?></td>
                                <!--Start Show Task For User If Session Admin-->

                                <?php if(Auth::user()->role == 1): ?>
                                    <?php if($taskdone->privacy == 0): ?> <td>Public Task</td>  <?php endif; ?>
                                    <?php $__currentLoopData = $usersFullNameAndIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskfor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($taskfor->id == $taskdone->privacy): ?>
                                            <td><?php echo e($taskfor->firstname); ?> <?php echo e($taskfor->name); ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <!--End Show Task For User If Session Admin-->
                                <td><a href="<?php echo e(route('TaskUndone', $taskdone->id)); ?>"
                                        class="btn btn-warning btn-sm rounded-0">Undone</a></td>
                                <!--Admin can remove task-->
                                <?php if(Auth::user()->approvement == 1 && Auth::user()->role == 1): ?>
                                    <td><a href="#" class="btn btn-danger btn-sm  rounded-0" data-bs-toggle="modal"
                                            data-bs-target="#RemoveTaskModal">Remove</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </tbody>
            </table>
        </section>
        <!--End Taks Done-->
        <!--Start Edit Tasks Modal-->
        <div class="modal fade" id="EditTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="EditTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo e(route('UpdateTask')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="EditTaskModalLabel">Edit Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="hidden" name="id" id="taskid" required>
                                    <select class="form-select" id="floatingSelectEditTask" name="foruser"
                                        aria-label="Floating label select example" required>
                                        <option selected>Select User</option>
                                        <option value="0">Public Task</option>
                                        <?php $__currentLoopData = $usersFullNameAndIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usersFullNameAndId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($usersFullNameAndId->id); ?>"><?php echo e($usersFullNameAndId->firstname); ?>

                                                <?php echo e($usersFullNameAndId->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <label for="floatingSelectEditTask"></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="tasktitle" class="form-control rounded-0" id="taskTitleEdit"
                                    placeholder="Task Title" value="delevery" required>
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control rounded-0" name="taskcontent" id="TaskContentEdit"
                                    placeholder="Type Task Here!" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm rounded-0">Edit Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Edit Tasks Modal-->
        <!--Start New Tasks Modal-->
        <div class="modal fade" id="AddNewTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="AddNewTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo e(route('tasks.store')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="AddNewTaskModalLabel">Add New Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectAddTask" name="privacy"
                                        aria-label="Floating label select example">
                                        <option selected>Select User</option>
                                        <option value="0">Public Task</option>
                                        <?php $__currentLoopData = $usersFullNameAndIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usersFullNameAndId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($usersFullNameAndId->id); ?>"><?php echo e($usersFullNameAndId->firstname); ?>

                                                <?php echo e($usersFullNameAndId->name); ?></option>
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
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm rounded-0">Add Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End New Tasks Modal-->

        <!--Start Remove Tasks Modal-->
        <div class="modal fade" id="RemoveTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="RemoveTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="removetaskform">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                            <h5 class="modal-title" id="RemoveTaskModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sure you want to remove this task!
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger btn-sm rounded-0">Remove Task</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove Tasks Modal-->
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/app/tasks.blade.php ENDPATH**/ ?>