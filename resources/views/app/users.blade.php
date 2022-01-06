@extends('layouts.app')

@section('content')
    @guest
    <script>window.location = "/login";</script>
    @endguest
    @auth

            <h2 class="mb-4">Users Manager</h2>
            <form action="">
            <div class="input-group mb-3">
                <a title="Add new user" class="add-r-button btn btn-success rounded-0"  data-bs-toggle="modal" data-bs-target="#AddNewUserModal" ><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                <input type="text" class="form-control rounded-0" placeholder="Username|First Name|Last Name| Role..." aria-label="Find!" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary rounded-0 finder_button" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
            </div>
        </form>

            @if (!$users->isEmpty())
                 <!--Start Users Manager table-->
                    <table class="table table-dark text-center">
                        <thead>
                            <tr>
                            <th scope="col">Joined Date</th>
                            <th scope="col">FullName</th>
                            <th scope="col">Username</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">Role</th>
                            <th scope="col">Cin</th>
                            <th scope="col">Approvement</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->created_at}}</th>
                                <td>{{$user->name}} {{$user->firstname}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @switch($user->role)
                                        @case(1)
                                            Admin
                                            @break

                                        @case(2)
                                            Invoice Manager
                                            @break

                                        @default
                                            Employer
                                    @endswitch
                                </td>
                                <td>{{$user->cin}}</td>
                                <td>
                                    @if ($user->approvement == 0)
                                        Not Approved <span class="badge bg-danger"><i class="fa fa-close"></i></span>
                                    @else
                                        Approved <span class="badge bg-success"><i class="fa fa-check"></i></span>
                                    @endif


                                </td>
                                <td><a href="#" class="btn btn-success btn-sm  rounded-0" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</a></td>
                                <td><a href="#" class="btn btn-danger btn-sm  rounded-0" data-bs-toggle="modal" data-bs-target="#RemoveuserModal" >Remove</a></td>
                                </tr>
                         @endforeach


                        </tbody>
                        </table>
                    <!--End Users Manager table-->
            @else
                 <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> No <strong>User</strong> to show</h5>
            @endif



        <!--Start New User Modal-->
        <div class="modal fade" id="AddNewUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddNewUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form action="">
                <div class="modal-content rounded-0">
                <div class="modal-header bg-success  rounded-0">
                    <h5 class="modal-title" id="AddNewUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control rounded-0" id="firstname">
                    </div>

                    <div class="mb-3">
                    <label for="lastname"  class="form-label">Last Name</label>
                    <input type="text" class="form-control rounded-0"  name="lastname" id="lastname">
                    </div>

                    <div class="mb-3">
                    <label for="username" class="form-label">Username <small class="text-muted">(Must be unique)</small></label>
                    <input type="text" class="form-control rounded-0" name="username" id="username">
                    </div>

                    <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control rounded-0" id="phone" name="phone">
                    </div>

                    <div class="mb-3">
                    <label for="role" class="form-lable">Roles</label>
                    <div class="form-floating">
                        <select class="form-select" id="role" name="role" aria-label="Role">
                        <option selected>Select  User</option>
                        <option value="1">Admin</option>
                        <option value="2">Invoice and client manager</option>
                        <option value="3">Task Manager</option>
                        <option value="4">Employee</option>
                        </select>
                        <label for="role">User Role</label>
                    </div>
                    </div>


                    <div class="mb-3">
                    <label for="cin" class="form-label">CIN</label>
                    <input type="text" class="form-control rounded-0" name="cin" id="cin">
                    </div>

                    <div class="mb-3">
                    <label for="cinimage" class="form-label">CIN Image</label>
                    <input type="file" class="form-control rounded-0" name="cinimage" id="cinimage">
                    </div>

                    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control rounded-0"  name="password" id="password">
                    </div>

                    <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="approvement" name="approvement">
                        <label class="form-check-label" for="approvement">Approved</label>
                    </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm rounded-0">Add User</button>
                </div>
                </div>
            </form>
            </div>
        </div>
        <!--End New User Modal-->

        <!--Start Edit User Modal-->
        <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form action="">
                <div class="modal-content rounded-0">
                <div class="modal-header bg-success  rounded-0">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control rounded-0" id="firstname" value="amine">
                    </div>

                    <div class="mb-3">
                    <label for="lastname"  class="form-label">Last Name</label>
                    <input type="text" class="form-control rounded-0"  name="lastname" id="lastname" value="aqebli">
                    </div>

                    <div class="mb-3">
                    <label for="username" class="form-label">Username <small class="text-muted">(Must be unique)</small></label>
                    <input type="text" class="form-control rounded-0" name="username" id="username" value="aqamine">
                    </div>

                    <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control rounded-0" id="phone" name="phone" value="0687591067">
                    </div>

                    <div class="mb-3">
                    <label for="role" class="form-lable">Roles</label>
                    <div class="form-floating">
                        <select class="form-select" id="role" name="role" aria-label="Role">
                        <option >Select  User</option>
                        <option value="1">Admin</option>
                        <option value="2" selected>Invoice and client manager</option>
                        <option value="3">Task Manager</option>
                        <option value="4">Employee</option>
                        </select>
                        <label for="role">User Role</label>
                    </div>
                    </div>


                    <div class="mb-3">
                    <label for="cin" class="form-label">CIN</label>
                    <input type="text" class="form-control rounded-0" name="cin" id="cin" value="EE975993">
                    </div>

                    <div class="mb-3">
                    <label for="cinimage" class="form-label">CIN Image</label>
                    <input type="file" class="form-control rounded-0" name="cinimage" id="cinimage">

                    <a class="btn btn-dark btn-sm rounded-0 mt-1"   data-bs-toggle="collapse" href="#cinOldPic" role="button" aria-expanded="false" aria-controls="cinOldPic">Show Image</a>
                    <div class="collapse" id="cinOldPic">
                        <div class="card card-body">
                        <img class="img-thumbnail" src="src/12.jpg" alt="CIN">
                        </div>
                    </div>

                    </div>

                    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control rounded-0"  name="password" id="password">
                    </div>

                    <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="approvement" name="approvement" checked>
                        <label class="form-check-label" for="approvement">Approved</label>
                    </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm rounded-0">Edit User</button>
                </div>
                </div>
            </form>
            </div>
        </div>
        <!--End Edit User Modal-->


                <!--Start Remove user Modal-->
                <div class="modal fade" id="RemoveuserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RemoveuserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                        <h5 class="modal-title" id="RemoveuserModalLabel">Warning!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <ul>
                            <li>All invoices created by this account will be <strong>Deleted</strong></li>
                            <li>All clients created by this account will be <strong>Deleted</strong></li>
                            <li>Sure you want to <strong>Delete</strong> this user?</li>
                        </ul>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0">Delete User</button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
                <!--End Remove user Modal-->


   @endauth
@endsection
