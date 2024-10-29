@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $competition->name }}</h1>
    <a href="{{ route('games.create', ['season_id' => $competition->season_id, 'competition_id' => $competition->id]) }}" class="btn btn-primary mb-3">Create New Game</a>

    {{ \Carbon\Carbon::parse($competition->season->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($competition->season->end_date)->format('d F Y') }}
    <br>{{ $competition->season->name }}
    <div class="card">
        <div class="card-body">
            <p class="card-text">

            </p>
    
            {{-- Show teams only if the competition is league or team_knockout --}}
            @if($competition->type === 'league' || $competition->type === 'team_knockout')
                <h5 class="card-title">Teams Participating</h5>
                @if($teams && $teams->isEmpty())
                    <p class="card-text">No teams found for this competition.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($teams as $team)
                            <li class="list-group-item">{{ $team->name }} (Captain: {{ $team->captain }}) (Vice Captain: {{ $team->vicecaptain }})</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('competitions.games', $competition->id) }}" class="btn btn-primary">View Games</a>
                @endif
            @endif
        </div>
    </div>

    <a href="{{ route('seasons.index') }}" class="btn btn-primary">Back to Seasons</a>

    <h1>{{ $competition->name }}</h1>
    <p>{{ $competition->description }}</p>

    <h2>Games</h2>
    @foreach($games as $date => $gamesOnDate)
        <h3>{{ $date }}</h3>
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
