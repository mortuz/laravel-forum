@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Update a question</div>

        <div class="card-body">
            <form action="{{ route('discussion.update', ['id' => $discussion->id ]) }}" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="10" class="form-control">{{ $discussion->content }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update question</button>
            </form>
        </div>
    </div>
@endsection
