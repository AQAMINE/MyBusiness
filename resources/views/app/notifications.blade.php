@extends('layouts.app')

@section('content')
    @guest
    <script>window.location = "/login";</script>
    @endguest
    @auth
        <h2 class="mb-4">Notifications</h2>

        <!--Start Notification-->
        @if($AllNotifications->isEmpty())
            <h5 class="text-center alert alert-secondary rounded-0"><i class="fa fa-check-circle" aria-hidden="true"></i> You Don't Have Any Notification To Show</h5>
        @else
            @foreach ($AllNotifications as $notification)
            <div class="alert alert-dark alert-dismissible fade show rounded-0" role="alert">
                <strong class="text-secondary">{{$notification->created_at->diffForHumans()}} |</strong> {{$notification->notification}}

                <form action="{{Route('notifications.destroy', $notification->id)}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button  class="btn-close delete-notification" ></button>
                </form>

            </div>
            @endforeach
        @endif


        <!--End Notification-->

   @endauth
@endsection
