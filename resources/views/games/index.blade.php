@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Games for Competition: {{ $competition->name }}</h1>
    <a href="{{ route('games.create', ['season_id' => $competition->season_id, 'competition_id' => $competition->id]) }}" class="btn btn-primary mb-3">Create New Game</a>

    @foreach($games as $date => $gamesOnDate)
        <h2>{{ $date }}</h2>
        <ul>
            @foreach($gamesOnDate as $game)
                <li>
                    {{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }} - {{ $game->home_score }}:{{ $game->away_score }}
                </li>
            @endforeach
        </ul>
    @endforeach
</div>
@endsection