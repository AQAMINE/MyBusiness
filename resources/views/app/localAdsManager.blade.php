@extends('layouts.app')

@section('content')
    @guest
        <script>
            window.location = "/login";
        </script>
    @endguest
    @auth
        <h2 class="mb-4">Local Ads</h2>
        @if (Auth::user()->approvement == 1 && Auth::user()->role == 1)
            <button title="Add new task" type="button" class="add-r-button btn btn-success rounded-0" data-bs-toggle="modal"
                data-bs-target="#AddNewLocalAdModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
        @endif
        {{-- Start Local Ads Manager --}}
        @foreach ($ads as $ad)
            <div class="card text-white bg-dark mb-1 rounded-0">

                <div class="card-header">
                    <small class="badge bg-primary text-light">By: {{ $ad->user->name }} {{ $ad->user->firstname }}</small>
                    <small class="badge bg-info text-dark">End Date: {{ $ad->end_date }}</small>
                    <small class="badge bg-light text-dark">{{ $ad->created_at->diffForHumans() }}</small>
                    <span class="ml-2">
                        @if ($ad->status == true)
                            <i class="fa fa-eye" style="color:green"></i>
                        @else
                            <i class="fa fa-eye-slash" style="color:red"></i>
                        @endif
                    </span>
                </div>

                <div class="card-body">
                    <!--<h5 class="card-title">Info card title</h5>-->
                    <p class="card-text">{{ $ad->content }}</p>
                </div>
                <div class="crad-footer mb-2">
                    <a href="#" onclick="transferDataToModal('#removeLocalAdForm','{{ route('LocalAds.destroy', $ad->id) }}')"
                        class="btn btn-danger btn-sm rounded-0 ml-2" data-bs-toggle="modal" data-bs-target="#RemoveLocalAd"><i
                            class="fa fa-trash"></i> Delete</a>

                    @if ($ad->status == true)
                        <a href="{{ route('HideShowLocalAd', $ad->id) }}" class="btn btn-warning btn-sm rounded-0 ml-2"><i
                                class="fa fa-eye-slash"></i> Hide</a>
                    @else
                        <a href="{{ route('HideShowLocalAd', $ad->id) }}" class="btn btn-warning btn-sm rounded-0 ml-2"><i
                                class="fa fa-eye"></i> Show</a>
                    @endif

                    <a href="#" class="btn btn-success btn-sm rounded-0 ml-2"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        @endforeach
        {{-- End Local Ads Manager --}}

        <!--Start New LocalAd Modal-->
        <div class="modal fade" id="AddNewLocalAdModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="AddNewLocalAdModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('LocalAds.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-success  rounded-0">
                            <h5 class="modal-title" id="AddNewLocalAdModalLabel">Add New Local Ad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="ad_content" class="form-label">Content</label>
                                <textarea class="form-control rounded-0" id="ad_content" name="content"
                                    placeholder="Type Local Ad Here!"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control rounded-0" id="start_date" name="created_at"
                                    placeholder="Start Date!">
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control rounded-0" id="end_date" name="end_date"
                                    placeholder="End Date!">
                            </div>



                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" checked>
                                    <label class="form-check-label" for="status">Show</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal"><i
                                    class="fa fa-remove"></i> Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm rounded-0"><i class="fa fa-plus"></i> Add
                                Ad</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End New LocalAd Modal-->

        <!--Start Remove Ad Modal-->
        <div class="modal fade" id="RemoveLocalAd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="RemoveLocalAdLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" id="removeLocalAdForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                            <h5 class="modal-title" id="RemoveLocalAdLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>Sure you want to <strong>Deleted</strong> this ad</li>
                                <li>You will not be able to <strong>Reset</strong></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary btn-sm rounded-0 text-light" data-bs-dismiss="modal"><i
                                    class="fa fa-remove"></i> Cancel</a>
                            <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash"></i> Delete
                                Ad</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove Ad Modal-->
    @endauth
@endsection
