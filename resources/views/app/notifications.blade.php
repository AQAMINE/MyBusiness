@extends('layouts.app')

@section('content')
    @guest
        <script>
            window.location = "/login";
        </script>
    @endguest
    @auth
        <h2 class="mb-4">Notifications</h2>

        <!--Start Notification-->
        @if ($AllNotifications->isEmpty())
            <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> You
                Don't Have Any Notification To Show</h5>
        @else
        <a href="#" class="btn btn-secondary btn-sm rounded-0 mb-2" data-bs-target="#CleareNotificationModal" data-bs-toggle="modal" >Clear All Notification</a>
            @foreach ($AllNotifications as $notification)
                <div class="alert alert-dark alert-dismissible fade show rounded-0" role="alert">
                    <strong class="text-secondary">{{ $notification->created_at->diffForHumans() }} |</strong>
                    {{ $notification->notification }}

                    <form action="{{ Route('notifications.destroy', $notification->id) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn-close delete-notification"></button>
                    </form>

                </div>
            @endforeach
        @endif

        {{-- Start Remove All Notification --}}
        <!--Start Remove user Modal-->
        <div class="modal fade" id="CleareNotificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="CleareNotificationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('clearNotifications')}}" method="post" >
                    {{ csrf_field() }}

                    <div class="modal-content rounded-0">
                        <div class="modal-header bg-danger  rounded-0">
                            <h5 class="modal-title" id="CleareNotificationModalLabel">Warning!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>Sure you want to cleare all your <strong>Notifications!</strong></li>

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-secondary btn-sm rounded-0 text-light"
                                data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger btn-sm rounded-0">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--End Remove user Modal-->
        {{-- End Remove All Notification --}}
        <!--End Notification-->

    @endauth
@endsection
