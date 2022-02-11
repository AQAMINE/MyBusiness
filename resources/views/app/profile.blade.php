@extends('layouts.app')

@section('content')
    @guest
        <script>
            window.location = "/login";
        </script>
    @endguest
    @auth
        {{-- <h2 class="mb-4">My Profile</h2> --}}

        @foreach ($datas as $data)

            <div class="card mb-3 bg-light rounded-0 profile_info_card" style="max-width: 100%;">
                <div class="row g-0 ">
                    <div class="col-md-4 ">
                        <img src="{{ asset('UsersProfilesPictures/' . Auth::user()->profile_pic) }}" class="img-fluid "
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body ">
                            <h5 class="card-title">{{ '@' . $data->username }} <small
                                    class="text-muted">{{ $data->name }}
                                    {{ $data->firstname }}</small>
                                @if ($data->approvement == 1)
                                    <span class="approvment text-success">Approved</span>
                                @else
                                    <span class="approvment text-danger">Not approved</span>
                                @endif
                            </h5>
                            <h5><strong class="text-success">Tasks Done: {{ $tasksdone }} <i class="fa fa-check"></i></strong> <strong
                                    class="text-danger">Undone Tasks: {{ $undoneTasks }} <i class="fa fa-remove"></i></strong></h5>
                            <p class="card-text">{{ $data->role_incompany }}</p>


                            <div class="card rounded-0 " style="width:100%;">
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item bg-light">+212 {{ $data->phone }}</li>
                                    <li class="list-group-item bg-light">{{ $data->email }}</li>
                                    <li class="list-group-item bg-light">
                                        @if ($data->role == 1)
                                            Admin
                                        @elseif ($data->role == 2)
                                            Invoice Manager
                                        @else
                                            Employer
                                        @endif
                                    </li>
                                    <li class="list-group-item bg-light">{{ $data->cin }}</li>
                                </ul>
                            </div>



                            <a href="{{route('editeProfile' , Auth::id())}}"class="btn btn-dark btn-sm text-light rounded-0 mt-2">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endauth
@endsection
