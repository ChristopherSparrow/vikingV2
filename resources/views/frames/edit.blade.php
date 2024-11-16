@extends('layouts.app')

@section('content')
<div class="container">
    <p style="margin:0px;"><a href="{{ route('games.show', $frame->game_id) }}"> &lt; Back</a></p>

 
    @php
        $homeTeam = $teams->where('id', $frame->game->home_team_id)->first();
        $awayTeam = $teams->where('id', $frame->game->away_team_id)->first();
    @endphp

    <h2>{{ $homeTeam->name }} v {{ $awayTeam->name }}</h2>
    <h2>Edit Frame {{ $frame->frame_number }}  </h2>
    <form action="{{ route('frames.update', $frame->id) }}" method="POST">
        @csrf
        @method('PUT')
    <div class="card mt-4">
        <div class="card-header">
        Home Player
        </div>
        <div class="card-body">
        <div class="form-group d-inline-block" style="width: 48%;">
            <label for="home_player_id">Name</label>
            <select name="home_player_id" id="home_player_id" class="form-control" required>
            @foreach($homeTeamPlayers as $player)
            <option value="{{ $player->id }}" {{ $frame->home_player_id == $player->id ? 'selected' : '' }}>{{ $player->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group d-inline-block" style="width: 15%; margin-left: 4%;">
            <label for="home_score">Score</label>
            <input type="number" name="home_score" id="home_score" class="form-control" value="{{ $frame->home_score }}" required>
        </div>
        <div class="form-group form-check">
            <input type="hidden" name="HomeFirst" value="0">
            <input type="checkbox" name="HomeFirst" id="HomeFirst" class="form-check-input" value="1" {{ $frame->HomeFirst ? 'checked' : '' }}>
            <label for="HomeFirst" class="form-check-label">First game?</label>
        </div>

        <div class="form-group form-check">
            <input type="hidden" name="Home8" value="0">
            <input type="checkbox" name="Home8" id="Home8" class="form-check-input" value="1" {{ $frame->Home8 ? 'checked' : '' }}>
            <label for="Home8" class="form-check-label">8 Ball Clearance?</label>
        </div>
        </div>
    </div>
        <div class="card mt-4">
            <div class="card-header">
            Away Player
            </div>
            <div class="card-body">
                <div class="form-group d-inline-block" style="width: 48%;">
                    <label for="away_player_id">Away Player</label>
                    <select name="away_player_id" id="away_player_id" class="form-control" required>
                    @foreach($awayTeamPlayers as $player)
                        <option value="{{ $player->id }}" {{ $frame->away_player_id == $player->id ? 'selected' : '' }}>{{ $player->name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group d-inline-block" style="width: 15%; margin-left: 4%;">
                    <label for="away_score">Score</label>
                    <input type="number" name="away_score" id="away_score" class="form-control" value="{{ $frame->away_score }}" required>
                </div>

                <div class="form-group form-check">
                    <input type="hidden" name="AwayFirst" value="0">
                    <input type="checkbox" name="AwayFirst" id="AwayFirst" class="form-check-input" value="1" {{ $frame->AwayFirst ? 'checked' : '' }}>
                    <label for="AwayFirst" class="form-check-label"> First Game?</label>
                </div>

                <div class="form-group form-check">
                    <input type="hidden" name="Away8" value="0">
                    <input type="checkbox" name="Away8" id="Away8" class="form-check-input" value="1" {{ $frame->Away8 ? 'checked' : '' }}>
                    <label for="Away8" class="form-check-label">8 Ball Clearance</label>
                </div>
            </div>
        </div>

        <p><br><button type="submit" class="btn btn-primary">Save</button></p>
    </form>
</div>
@endsection