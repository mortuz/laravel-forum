@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">Channels</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach ($channels as $channel)
                                <tr>
                                    <td>{{ $channel->title }}</td>
                                    <td>
                                        <a href="{{ route('channels.edit', ['channel' => $channel->id]) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                        <form action="{{ route('channels.destroy', ['channel' => $channel->id]) }}" method="post" class="d-inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
