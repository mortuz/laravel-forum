@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Update a reply</div>

        <div class="card-body">
            <form action="{{ route('reply.update', ['id' => $reply->id ]) }}" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="content">Update your answer</label>
                    <textarea name="content" id="content" rows="10" class="form-control">{{ $reply->content }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update reply</button>
            </form>
        </div>
    </div>
@endsection
