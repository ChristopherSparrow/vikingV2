
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Frames</h1>
    <a href="{{ route('frames.create') }}" class="btn btn-primary">Create Frame</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Game ID</th>
                <th>Home Player</th>
                <th>Away Player</th>
                <th>Frame Number</th>
                <th>Home Score</th>
                <th>Away Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($frames as $frame)
            <tr>
                <td>{{ $frame->id }}</td>
                <td>{{ $frame->game_id }}</td>
                <td>{{ $frame->homePlayer->name }}</td>
                <td>{{ $frame->awayPlayer->name }}</td>
                <td>{{ $frame->frame_number }}</td>
                <td>{{ $frame->home_score }}</td>
                <td>{{ $frame->away_score }}</td>
                <td>
                    <a href="{{ route('frames.show', $frame->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('frames.edit', $frame->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('frames.destroy', $frame->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection