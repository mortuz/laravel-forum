@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit channel: {{ $channel->title }}</div>

        <div class="card-body">
            <form action="{{ route('channels.update', ['channel' => $channel->id]) }}" method="post">

                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $channel->title }}">
                </div>

                <button type="submit" class="btn btn-primary">Update channel</button>
            </form>
        </div>
    </div>
@endsection
