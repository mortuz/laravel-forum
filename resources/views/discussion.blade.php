@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add a question</div>

        <div class="card-body">
            <form action="{{ route('discussions.store') }}" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="channel">Pick a channel</label>
                    <select name="channel_id" id="channel" class="form-control">
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected': '' }}>{{ $channel->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="10" class="form-control">{{ old('content') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add a question</button>
            </form>
        </div>
    </div>
@endsection
