@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a New Game</h1>
    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <!-- Season -->
        <div class="form-group">
            <label for="season_id">Season</label>
            <select name="season_id" id="season_id" class="form-control" required>
                @foreach($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Competition -->
        <div class="form-group">
            <label for="competition_id">Competition</label>
            <select name="competition_id" id="competition_id" class="form-control" required>
            @foreach($competitions->where('season_id', request('season_id', old('season_id'))) as $competition)
                <option value="{{ $competition->id }}">{{ $competition->name }}</option>
            @endforeach
            </select>
        </div>
        <!-- Home Team -->
        <div class="form-group">
            <label for="home_team_id">Home Team</label>
            <select name="home_team_id" id="home_team_id" class="form-control" required>
                @foreach($teams->where('season_id', request('season_id', old('season_id'))) as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Away Team -->
        <div class="form-group">
            <label for="away_team_id">Away Team</label>
            <select name="away_team_id" id="away_team_id" class="form-control" required>
                @foreach($teams->where('season_id', request('season_id', old('season_id'))) as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Date -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <!-- Home Score -->
        <div class="form-group">
            <label for="home_score">Home Score</label>
            <input type="number" name="home_score" id="home_score" class="form-control">
        </div>
        <!-- Away Score -->
        <div class="form-group">
            <label for="away_score">Away Score</label>
            <input type="number" name="away_score" id="away_score" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Game</button>
    </form>
</div>
@endsection