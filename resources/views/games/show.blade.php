@extends('layouts.app')

@section('content')
<div class="container">
    <p style="margin:0px;"><a href="{{ route('competitions.show', $game->competition->id) }}"> &lt; Back</a></p>

    <h1>{{ $game->homeTeam->name }} 
        @if($game->home_score !== null)
            ({{ $game->home_score }})
        @endif
        v 
        @if($game->away_score !== null)
            ({{ $game->away_score }})
        @endif
        {{ $game->awayTeam->name }}
    </h1>
    <p>{{ $game->competition->name }} - {{ $game->date }}</p>

    @if($frames->isEmpty())
        <p>No frames found for this game.</p>
    @else
        <table class="table">
            <thead>
                <tr>

                    <th colspan="2"><p style="margin:0px;">Home</p></th>
                    <th colspan="2"><p style="margin:0px; text-align:right;">Away</p></th>
                </tr>
            </thead>
            <tbody>
                @foreach($frames as $frame)
                <tr>

                    <td>{{ $frame->homePlayer->name }}</td>
                    <td>{{ $frame->home_score }}</td>
                    <td>{{ $frame->away_score }}</td>
                    <td ><p style="margin:0px; text-align:right;">{{ $frame->awayPlayer->name }}</p></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Add New Frame</h2>
    <form action="{{ route('frames.store') }}" method="POST">
        @csrf
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <div class="form-group">
            <label for="home_player_id">Home Player</label>
            <select name="home_player_id" class="form-control" required>
            <option value="" disabled selected>Home Player</option>
            @foreach($game->homeTeam->players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="away_player_id">Away Player</label>
            <select name="away_player_id" class="form-control" required>
                <option value="" disabled selected>Away Player</option>
                @foreach($game->awayTeam->players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="frame_number">Frame Number</label>
            <input type="number" name="frame_number" class="form-control" required min="1" max="12" value="{{ $frames->count() + 1 }}" readonly>
        </div>

        <div class="form-group">
            <label for="winner">Winner</label>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="winner" id="home" autocomplete="off" value="home" checked> Home
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="winner" id="away" autocomplete="off" value="away"> Away
                </label>
            </div>
        </div>

        <input type="hidden" name="home_score" id="home_score" value="1">
        <input type="hidden" name="away_score" id="away_score" value="0">

        <script>
            document.querySelectorAll('input[name="winner"]').forEach((elem) => {
                elem.addEventListener("change", function(event) {
                    if (event.target.value === "home") {
                        document.getElementById('home_score').value = 1;
                        document.getElementById('away_score').value = 0;
                    } else {
                        document.getElementById('home_score').value = 0;
                        document.getElementById('away_score').value = 1;
                    }
                });
            });
        </script>
        <button type="submit" class="btn btn-primary">Add Frame</button>
    </form>
</div>
@endsection