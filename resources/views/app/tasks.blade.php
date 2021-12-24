@extends('layouts.app')

@section('content')
    @guest
    <script>window.location = "/login";</script>
    @endguest
    @auth
        <h2 class="mb-4">Taks</h2>
       @if (Auth::user()->approvement == 1  && Auth::user()->role == 1)
         <button title="Add new task" type="button" class="add-r-button btn btn-success rounded-0"  data-bs-toggle="modal" data-bs-target="#AddNewTaskModal" ><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
       @endif
        <!--Start Task Toast-->
        <div class="row">

            @if($tasks->isEmpty())
             <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> All <strong>Tasks</strong> Done</h5>
            @else
                @foreach ($tasks as $task)
                    @if ($task->done == 0 )
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="toast rounded-0 fade show" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" >
                                <div class="toast-header">
                                <small class="badge bg-dark text-light">{{$task->created_at->diffForHumans()}}</small>|
                                <strong class="me-auto">
                                <!--Strat if user is admin show here task for user (user firstname and last name) if a normal user show here task aded by admin fullname-->
                                    @if (Auth::user()->role == 1)
                                        @foreach ($usersFullNameAndIds as $info)
                                            @if ($info->id == $task->privacy)
                                                {{$info->firstname}} {{$info->name}}
                                            @endif
                                        @endforeach
                                    @else {{$task->user->firstname}} {{$task->user->name}}</strong> @endif </strong>
                                <!--End if user is admin show here task for user (user firstname and last name) if a normal user show here task aded by admin fullname-->
                                <strong>{{$task->taskTitle}}</strong>
                                </div>
                                <div class="toast-body">
                                {{$task->task}}
                                <div class="mt-2 pt-2 border-top">
                                    <!--Admin can remove/Edit task-->
                                    @if (Auth::user()->approvement == 1  && Auth::user()->role == 1)
                                        <a  onclick="EditTask({{$task->id}},{{$task->privacy}},'{{$task->taskTitle}}','{{$task->task}}')" class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#EditTaskModal">Edit</a>

                                        <form action="{{Route('tasks.destroy',$task->id)}}" method="POST" style="display: inline-block">
                                            {{csrf_field()}}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" onclick="return confirm('Sure you want to remove this task?','Warning!')" class="btn btn-danger btn-sm rounded-0 text-light">Delete</button>
                                        </form>
                                    @endif
                                    <a href="{{route('TaskDone', $task->id)}}" class="btn btn-success btn-sm rounded-0 text-light" >Done</a>
                                </div>
                                </div>
                            </div>
                        </div>

                    @endif
                @endforeach
            @endif








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
                @if (Auth::user()->role == 1)
                    <th scope="col">Task For User</th>
                @endif
                <!--End Show Task For User If Session Admin-->
                <th scope="col">Undone</th>
                <!--Admin can remove task-->
                @if (Auth::user()->approvement == 1  && Auth::user()->role == 1)
                    <th scope="col">Remove</th>
                @endif
            </tr>
            </thead>
            <tbody>

                @foreach ($tasks as $taskdone)
                    @if ($taskdone->done == 1)
                        <tr>
                            <th scope="row">{{$taskdone->user->firstname}} {{$taskdone->user->name}}</th>
                            <td>{{$taskdone->taskTitle}}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{$taskdone->task}}</td>
                            <td>{{$taskdone->created_at}}</td>
                            <td>{{$taskdone->updated_at}}</td>
                        <!--Start Show Task For User If Session Admin-->

                                @if (Auth::user()->role == 1)
                                    @if($taskdone->privacy == 0) <td>Public Task</td>  @endif
                                    @foreach ($usersFullNameAndIds as $taskfor)
                                        @if ($taskfor->id == $taskdone->privacy)
                                            <td>{{$taskfor->firstname}} {{$taskfor->name}}</td>
                                        @endif
                                    @endforeach
                                @endif

                        <!--End Show Task For User If Session Admin-->
                            <td><a href="{{route('TaskUndone', $taskdone->id)}}"  class="btn btn-warning btn-sm rounded-0">Undone</a></td>
                            <!--Admin can remove task-->
                            @if (Auth::user()->approvement == 1  && Auth::user()->role == 1)
                              <td><a href="#" class="btn btn-danger btn-sm  rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveTaskModal">Remove</a></td>
                            @endif
                        </tr>
                    @endif
                @endforeach


            </tbody>
        </table>
        </section>
        <!--End Taks Done-->
        <!--Start Edit Tasks Modal-->
        <div class="modal fade" id="EditTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('UpdateTask')}}" method="POST">
                {{csrf_field()}}
            <div class="modal-content rounded-0">
                <div class="modal-header bg-success  rounded-0">
                <h5 class="modal-title" id="EditTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <div class="form-floating">
                        <input type="hidden" name="id" id="taskid" required>
                    <select class="form-select" id="floatingSelectEditTask" name="foruser" aria-label="Floating label select example" required>
                        <option selected>Select  User</option>
                        <option value="0">Public Task</option>
                        @foreach ($usersFullNameAndIds as $usersFullNameAndId)
                        <option value="{{$usersFullNameAndId->id}}">{{$usersFullNameAndId->firstname}} {{$usersFullNameAndId->name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelectEditTask"></label>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" name="tasktitle" class="form-control rounded-0" id="taskTitleEdit" placeholder="Task Title" value="delevery" required>
                </div>

                <div class="mb-3">
                    <textarea class="form-control rounded-0" name="taskcontent" id="TaskContentEdit" placeholder="Type Task Here!" required></textarea>
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
        <div class="modal fade" id="AddNewTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddNewTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('tasks.store')}}" method="POST">
                {{csrf_field()}}
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
                        @foreach ($usersFullNameAndIds as $usersFullNameAndId)
                        <option value="{{$usersFullNameAndId->id}}">{{$usersFullNameAndId->firstname}} {{$usersFullNameAndId->name}}</option>
                        @endforeach
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
            <form action="" method="POST" id="removetaskform">
                {{csrf_field()}}
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
   @endauth
@endsection
