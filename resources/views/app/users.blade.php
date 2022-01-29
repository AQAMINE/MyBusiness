@extends('layouts.app')

@section('content')
    @guest
        <script>
            window.location = "/login";
        </script>
    @endguest
    @auth

        <h2 class="mb-4">Users Manager</h2>
        <form action="{{ route('find.user') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <a title="Add new user" class="add-r-button btn btn-success rounded-0" data-bs-toggle="modal"
                    data-bs-target="#AddNewUserModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                <input type="text" class="form-control rounded-0" placeholder="Username|First Name|Last Name| Role..."
                    aria-label="Find!" aria-describedby="button-addon2" name="keyword">
                <button class="btn btn-outline-secondary rounded-0 finder_button" type="submit" id="button-addon2"><i
                        class="fa fa-search"></i></button>
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
                            <th scope="row">{{ $user->created_at }}</th>
                            <td>{{ $user->name }} {{ $user->firstname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->phone }}</td>
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
                            <td>{{ $user->cin }}</td>
                            <td>
                                @if ($user->approvement == 0)
                                    Not Approved <span class="badge bg-danger"><i class="fa fa-close"></i></span>
                                @else
                                    Approved <span class="badge bg-success"><i class="fa fa-check"></i></span>
                                @endif


                            </td>
                            <td><a href="#"
                                    onclick="EditUser({{ $user->id }},'{{ $user->name }}','{{ $user->firstname }}','{{ $user->username }}','{{ $user->email }}','{{ $user->phone }}',{{ $user->role }},'{{ $user->cin }}',{{ $user->approvement }})"
                                    class="btn btn-success btn-sm  rounded-0" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal">Edit</a></td>
                            <td><a dataid="" onclick="movedata('{{ route('user.destroy', $user->id) }}')"
                                    href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger btn-sm  rounded-0"
                                    data-bs-toggle="modal" data-bs-target="#RemoveuserModal" id="removeBtn">Remove</a></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <!--End Users Manager table-->
        @else
            <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> No
                <strong>User</strong> to show
            </h5>
        @endif




        <!--Start New User Modal-->
        <div class="modal fade" id="AddNewUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="AddNewUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('user.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="AddNewUserModalLabel">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="firs_tname" class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control rounded-0" id="firs_tname">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control rounded-0" name="lastname" id="last_name">
                            </div>

                            <div class="mb-3">
                                <label for="user_name" class="form-label">Username <small class="text-muted">(Must be
                                        unique)</small></label>
                                <input type="text" class="form-control rounded-0" name="username" id="user_name">
                            </div>

                            <div class="mb-3">
                                <label for="emailA" class="form-label">Email <small class="text-muted">(Must be
                                        unique)</small></label>
                                <input type="email" class="form-control rounded-0" id="emailA" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="phoneA" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control rounded-0" id="phoneA" name="phone">
                            </div>

                            <div class="mb-3">
                                <label for="RoleA" class="form-lable">Roles</label>
                                <div class="form-floating">
                                    <select class="form-select" id="RoleA" name="role" aria-label="RoleA">
                                        <option>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Invoice and client manager</option>
                                        <option value="3">Employee</option>
                                    </select>
                                    <label for="RoleA">User Role</label>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="cinA" class="form-label">CIN</label>
                                <input type="text" class="form-control rounded-0" name="cin" id="cinA">
                            </div>


                            <div class="mb-3">
                                <label for="password_A" class="form-label">Password</label>
                                <input type="password" class="form-control rounded-0" name="password" id="password_A">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="approvement_A"
                                        name="approvement">
                                    <label class="form-check-label" for="approvement_A">Approved</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm rounded-0">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End New User Modal-->

        <!--Start Edit User Modal-->
        <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('UpdateUser') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="idEdit">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control rounded-0" id="firstname">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" class="form-control rounded-0" name="lastname" id="name">
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username <small class="text-muted">(Must be
                                        unique)</small></label>
                                <input type="text" class="form-control rounded-0" name="username" id="username">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <small class="text-muted">(Must be
                                        unique)</small></label>
                                <input type="email" class="form-control rounded-0" name="email" id="email">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control rounded-0" id="phone" name="phone">
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-lable">Roles</label>
                                <div class="form-floating">
                                    <select class="form-select" id="role" name="role" aria-label="Role">
                                        <option>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Invoice and client manager</option>
                                        <option value="3">Employee</option>
                                    </select>
                                    <label for="role">User Role</label>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" class="form-control rounded-0" name="cin" id="cin">
                            </div>

                            <div class="mb-3">
                                <label for="id_card" class="form-label">CIN Image</label>
                                <input type="file" class="form-control rounded-0" name="id_card" id="id_card">



                            </div>


                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="approvement"
                                        name="approvement">
                                    <label class="form-check-label" for="approvement">Approved</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm rounded-0">Edit User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Edit User Modal-->


        <!--Start Remove user Modal-->
        <div class="modal fade" id="RemoveuserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="RemoveuserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" id="deleteForm">
                    {{ csrf_field() }}
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
                                <li>Sure you want to <strong>Delete</strong> this user?</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary btn-sm rounded-0 text-light"
                                data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger btn-sm rounded-0">Delete User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove user Modal-->


    @endauth
@endsection
