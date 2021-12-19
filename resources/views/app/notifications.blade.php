@extends('layouts.app')

@section('content')
    @guest
    <script>window.location = "/login";</script>
    @endguest
    @auth
        <h2 class="mb-4">Notifications</h2>

        <!--Start Notification-->
        @foreach ($AllNotifications as $notification)
        <div class="alert alert-dark alert-dismissible fade show rounded-0" role="alert">
            <strong class="text-secondary">{{$notification->created_at->diffForHumans()}} |</strong> {{$notification->notification}}
            <a  class="btn-close delete-notification" data-bs-dismiss="alert" aria-label="Close"></a>
          </div>
        @endforeach
        <!--End Notification-->

   @endauth
@endsection
