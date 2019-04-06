@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <img src="{{ $discussion->user->avatar }}" alt="" width="40" height="40"> &nbsp;&nbsp;&nbsp;
            <span><strong>{{ $discussion->user->name }} ({{ $discussion->user->points }})</strong> created </span>
            <span class="text-primary">{{ $discussion->created_at->diffForHumans() }}</span>


            @if (Auth::id() == $discussion->user_id)
                @if (!$discussion->hasBestAnswer())
                    <a href="{{ route('discussion.edit', ['slug' => $discussion->slug]) }}" class="btn btn-info mr-2 btn-sm float-right">Edit</a>
                @endif
            @endif

            @if ($discussion->is_being_watched_by_user())
                <a href="{{ route('discussion.unwatch', ['id' => $discussion->id]) }}" class="btn btn-danger btn-sm float-right">Unwatch</a>
            @else
                <a href="{{ route('discussion.watch', ['id' => $discussion->id]) }}" class="btn btn-success btn-sm float-right">Watch</a>
            @endif

            @if ($discussion->hasBestAnswer())
                <span class="btn btn-danger btn-sm mr-2 float-right">CLOSED</span>
            @else
                <span class="btn btn-success  btn-sm mr-2 float-right">OPEN</span>
            @endif
        </div>

        <div class="card-body">
            <h4>
                <strong>{{ $discussion->title}}</strong>
            </h4>

            {!! Markdown::convertToHtml($discussion->content) !!}

            <hr>

            @if ($best_answer)
                <div class="card border-success">
                    <div class="card-header bg-light">
                        <img src="{{ $best_answer->user->avatar }}" alt="" width="40" height="40"> &nbsp;&nbsp;&nbsp;
                        <span><strong>{{ $best_answer->user->name }} ({{ $best_answer->user->points }})</strong></span>
                    </div>

                    <div class="card-body">
                        {!! Markdown::convertToHtml($best_answer->content) !!}
                    </div>
                </div>
            @endif

        </div>

        <div class="card-footer">
            <span class="text-muted m-0">{{ $discussion->replies->count() }} Replies</span>

            <a href="{{ route('channel', ['slug' => $discussion->channel->slug ]) }}" class="float-right btn btn-light btn-sm">{{ $discussion->channel->title }}</a>
        </div>
    </div>

        @foreach ($discussion->replies as $reply)
            <div class="card mb-3">
                <div class="card-header">
                    <img src="{{ $reply->user->avatar }}" alt="" width="40" height="40"> &nbsp;&nbsp;&nbsp;
                    <span><strong>{{ $reply->user->name }}({{ $reply->user->points }})</strong> replies </span>
                    <span class="text-primary">{{ $reply->created_at->diffForHumans() }}</span>

                    @if (!$best_answer)
                        @if (Auth::id() == $discussion->user_id)
                            <a href="{{ route('discussion.best_answer', ['id' => $reply->id]) }}" class="btn btn-xs float-right btn-info text-light">Mark as best answer</a>                            
                        @endif
                    @endif

                    @if (Auth::id() == $reply->user_id)
                        @if (!$reply->best_answer)
                           <a href="{{ route('reply.edit', ['id' => $reply->id]) }}" class="btn btn-xs float-right btn-info text-light">Edit</a> 
                        @endif
                    @endif
                </div>

                <div class="card-body">

                    {!! Markdown::convertToHtml($reply->content) !!}

                    <p class="m-0"><small class="text-muted">{{ $reply->likes->count() }} likes</small></p>
                </div>

                <div class="card-footer">

                    @if ($reply->is_liked_by_auth_user())
                        <a href="{{ route('reply.unlike', ['id' => $reply->id]) }}" class="btn btn-outline-danger btn-sm">Unlike</a>
                    @else
                        <a href="{{ route('reply.like', ['id' => $reply->id]) }}" class="btn btn-outline-success btn-sm">Like</a>
                    @endif
                </div>
            </div>
        @endforeach

        @if (Auth::check())
            <div class="card">
            <div class="card-body">
                <form action="{{ route('discussion.reply', ['id' => $discussion->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" rows="5" class="form-control"></textarea>
                    </div>


                    <button type="submit" class="btn btn-outline-primary">Leave a reply</button>
                </form>
            </div>
        </div>
        @else
            <div class="card">
            <div class="card-body">
                <h2 class="text-center">Sign in to reply</h2>
            </div>
        </div>
        @endif
@endsection
