@extends('layouts.app')

@section('content')

    @foreach ($discussions as $discussion)
        <div class="card mb-3">
            <div class="card-header">
                <img src="{{ $discussion->user->avatar }}" alt="" width="40" height="40"> &nbsp;&nbsp;&nbsp;
                <span><strong>{{ $discussion->user->name }}</strong> created </span>
                <span class="text-primary">{{ $discussion->created_at->diffForHumans() }}</span>
                <a href="{{ route('discussion', ['slug' => $discussion->slug]) }}" class="btn btn-primary btn-sm float-right">View</a>

                @if ($discussion->hasBestAnswer())
                    <span class="btn btn-success btn-sm mr-2 float-right">CLOSED</span>
                @else
                    <span class="btn btn-danger  btn-sm mr-2 float-right">OPEN</span>
                @endif
            </div>

            <div class="card-body">
                <h4>
                    <strong>{{ $discussion->title}}</strong>
                </h4>

                <p>{{ str_limit($discussion->content, 200) }}</p>

            </div>

            <div class="card-footer">
                <span class="text-muted m-0">{{ $discussion->replies->count() }} Replies</span>

                <a href="{{ route('channel', ['slug' => $discussion->channel->slug ]) }}" class="float-right btn btn-light btn-sm">{{ $discussion->channel->title }}</a>
            </div>
        </div>
    @endforeach

    <div class="text-center mt-3">
        {{ $discussions->links() }}
    </div>

@endsection
