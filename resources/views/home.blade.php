@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>News <i class="fa fa-newspaper-o"></i></h1>
                @foreach ($ads as $ad)
                <div class="card text-white bg-dark mb-3 rounded-0">
                    <div class="card-header">
                        <small class="badge bg-primary text-light">By: {{ $ad->user->name }} {{ $ad->user->firstname }}</small>
                        <small class="badge bg-light text-dark">{{$ad->created_at->diffForHumans() }}</small>
                    </div>

                    <div class="card-body">
                        <!--<h5 class="card-title">Info card title</h5>-->
                        <p class="card-text">{{ $ad->content }}</p>
                    </div>

                </div>
            @endforeach

    </div>
@endsection
