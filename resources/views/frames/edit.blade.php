@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Frame</h2>
    <form action="{{ route('frames.update', $frame->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="home_player_id">Home Player</label>
            <select name="home_player_id" id="home_player_id" class="form-control" required>
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $frame->home_player_id == $player->id ? 'selected' : '' }}>{{ $player->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="away_player_id">Away Player</label>
            <select name="away_player_id" id="away_player_id" class="form-control" required>
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $frame->away_player_id == $player->id ? 'selected' : '' }}>{{ $player->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="home_score">Home Score</label>
            <input type="number" name="home_score" id="home_score" class="form-control" value="{{ $frame->home_score }}" required>
        </div>

        <div class="form-group">
            <label for="away_score">Away Score</label>
            <input type="number" name="away_score" id="away_score" class="form-control" value="{{ $frame->away_score }}" required>
        </div>

        <div class="form-group form-check">
            <input type="hidden" name="HomeFirst" value="0">
            <input type="checkbox" name="HomeFirst" id="HomeFirst" class="form-check-input" value="1" {{ $frame->HomeFirst ? 'checked' : '' }}>
            <label for="HomeFirst" class="form-check-label">Home First</label>
        </div>

        <div class="form-group form-check">
            <input type="hidden" name="Home8" value="0">
            <input type="checkbox" name="Home8" id="Home8" class="form-check-input" value="1" {{ $frame->Home8 ? 'checked' : '' }}>
            <label for="Home8" class="form-check-label">Home 8</label>
        </div>

        <div class="form-group form-check">
            <input type="hidden" name="AwayFirst" value="0">
            <input type="checkbox" name="AwayFirst" id="AwayFirst" class="form-check-input" value="1" {{ $frame->AwayFirst ? 'checked' : '' }}>
            <label for="AwayFirst" class="form-check-label">Away First</label>
        </div>

        <div class="form-group form-check">
            <input type="hidden" name="Away8" value="0">
            <input type="checkbox" name="Away8" id="Away8" class="form-check-input" value="1" {{ $frame->Away8 ? 'checked' : '' }}>
            <label for="Away8" class="form-check-label">Away 8</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Frame</button>
    </form>
</div>
@endsection