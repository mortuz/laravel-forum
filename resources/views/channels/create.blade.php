@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">Create channel</div>

                <div class="card-body">
                   <form action="{{ route('channels.store') }}" method="post">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Create channel</button>
                    </form>
                </div>
            </div>
@endsection
