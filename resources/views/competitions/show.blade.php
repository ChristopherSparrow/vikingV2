@extends('layouts.app')

@section('content')
<div class="container"style="padding-top:10px;">
    <p style="margin:0px;"><a href="/">&lt; Back</a></p>
    <h1>{{ $competition->name }}</h1>
    <p>
        {{ $competition->season->name }} <br>
        {{ \Carbon\Carbon::parse($competition->season->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($competition->season->end_date)->format('d F Y') }}
    </p>
    <div class="row">
        <h2>League Table</h2>
<!-- Create a league table based on the games played in this competition -->
        @if($competition->type === 'league')
            @if($teams && $teams->isEmpty())
                <p class="card-text">No teams found for this competition.</p>
            @else
                <div class="col-lg-4 mb-2">
                    <div class="card card-viking">
                        <div class="card-body">
                            <table class="table" style="width:100%;">
                                <tr>
                                    <td>Team</td>
                                    <td>Played</td>
                                    <td>Won</td>
                                    <td>Drawn</td>
                                    <td>Lost</td>
                                    <td style="text-align: right;">Points</td>
                                </tr>
                                @foreach($teams as $team)
                                @php
                                    $played = $team->games->where('competition_id', $competition->id)->count();
                                 
                                    $won = $team->games->filter(function($game) use ($team, $competition) {
                                        return $game->competition_id == $competition->id && (
                                            ($game->home_team_id == $team->id && $game->home_score > $game->away_score) ||
                                            ($game->away_team_id == $team->id && $game->away_score > $game->home_score)
                                        );
                                    })->count();
                                    $drawn = $team->games->filter(function($game) use ($competition) {
                                        return $game->competition_id == $competition->id && $game->home_score == $game->away_score;
                                    })->count();
                                    $lost = $played - $won - $drawn;
                                    $points = $team->games->where('competition_id', $competition->id)->sum(function($game) use ($team) {
                                        if ($game->home_team_id == $team->id) {
                                            return $game->home_score;
                                        } elseif ($game->away_team_id == $team->id) {
                                            return $game->away_score;
                                        }
                                        return 0;
                                    });
                                
                                @endphp
                                <tr>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $played }}</td>
                                    <td>{{ $won }}</td>
                                    <td>{{ $drawn }}</td>
                                    <td>{{ $lost }}</td>
                                    <td style="text-align: right;">{{ $points }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endif    

        @if($competition->type === 'league' || $competition->type === 'team_knockout')
            @if($teams && $teams->isEmpty())
                <p class="card-text">No teams found for this competition.</p>
            @else
                <h2>Fixtures & Results</h2>
                @foreach($games as $date => $gamesOnDate)
                <div class="col-lg-4 mb-2">
                    <div class="card card-viking">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between align-items-center" style="margin:0px;">
                                <div class="d-flex align-items-center">{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</div>            
                            </div>
                            <table style="width: 100%;">
                                @foreach($gamesOnDate as $game)
                                <tr>

                                        <td>
                                            <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px;">
                                                {{ $game->homeTeam->name }}<br>{{ $game->awayTeam->name }}
                                            </p>
                                        </td>

                                    @if($competition->type === 'league')
                                    <td>
                                        <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px; text-align: left;">
                                            <i class="bi bi-info-circle"></i>
                                        </p>
                                    </td>
                                    @endif
                                    <td>
                                        <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px; text-align: right;">
                                            {{ $game->home_score ?? 0 }}<br>{{ $game->away_score ?? 0 }}
                                        </p>
                                    </td>
                                </tr>
                            
                
                            @endforeach
                        </table>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        
        @endif
    </div>



    <p><a href="/" class="btn btn-primary">Home</a>
       
        <a href="{{ route('seasons.index') }}" class="btn btn-primary">Back to Seasons</a>
        <a href="{{ route('games.create', ['season_id' => $competition->season_id, 'competition_id' => $competition->id]) }}" class="btn btn-primary">Create New Game</a>
    </p>



</div>
@endsection
