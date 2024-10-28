@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a New Player to {{ $season->name }}</h1>
    <form action="{{ route('players.store', $season->id) }}" method="POST">
        @csrf
        <!-- Player Name -->
        <div class="form-group">
            <label for="name">Player Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
    
        <!-- Player Team -->
        <div class="form-group">
            <label for="team_id">Team</label>
            <select name="team_id" id="team_id" class="form-control" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Player</button>
    </form>
</div>
@endsection