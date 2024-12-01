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

        @if($competition->type === 'league')
            @if($teams && $teams->isEmpty())
                <p class="card-text">No teams found for this competition.</p>
            @else
            <!--Add a link to the mostwins page-->
            <p><a href="{{ route('games.mostwins', ['competition' => $competition->id]) }}" class="btn btn-primary">Most Wins</a>   
            <a href="{{ route('games.totalclearances', ['competition' => $competition->id]) }}" class="btn btn-primary">Eight Ball Clearnances</a>   </p>
            @endif
        @endif


        @if($competition->type === 'league')
            @if($teams && $teams->isEmpty())
                <p class="card-text">No teams found for this competition.</p>
            @else
                <div class="col-lg-4 mb-2">
                    <div class="card card-viking">
                        <div class="card-body">
                              <h2>League Table</h2>
                            <table class="table" style="width:100%;">
                                <tr>
                                    <td>Team</td>
                                    <td>Played</td>
                                    <td>Won</td>
                                    <td>Drawn</td>
                                    <td>Lost</td>
                                    <td style="text-align: right;">Points</td>
                                </tr>
  
                                @php
                                    $teams = $teams->sortByDesc(function($team) use ($competition) {
                                        return $team->games->where('competition_id', $competition->id)->sum(function($game) use ($team) {
                                            if ($game->home_team_id == $team->id) {
                                                return $game->home_score;
                                            } elseif ($game->away_team_id == $team->id) {
                                                return $game->away_score;
                                            }
                                            return 0;
                                        });
                                    });
                                @endphp

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
            <div class="col-lg-4 mb-2">
                <div class="card card-viking">
                    <div class="card-body">
                        <h2>Fixtures & Results</h2>
                        <div class="accordion" id="fixturesAccordion">
                            @foreach($games as $date => $gamesOnDate)
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ \Carbon\Carbon::parse($date)->format('Ymd') }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ \Carbon\Carbon::parse($date)->format('Ymd') }}" aria-expanded="true" aria-controls="collapse-{{ \Carbon\Carbon::parse($date)->format('Ymd') }}">
                                @if($competition->type === 'team_knockout')
                                    {{ \Carbon\Carbon::parse($date)->format('d F Y') }} - Round {{ $gamesOnDate->first()->round }}
                                @else
                                    {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
                                @endif
                                </button>
                            </h2>
                            <div id="collapse-{{ \Carbon\Carbon::parse($date)->format('Ymd') }}" class="accordion-collapse  collapse" aria-labelledby="heading-{{ \Carbon\Carbon::parse($date)->format('Ymd') }}" data-bs-parent="#fixturesAccordion">
                                <div class="accordion-body ">
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
                                        <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px; text-align: left; font-size:1.5rem;">
                                        <a style="color:#ffffff;" href="{{ route('games.show', ['game' => $game->id]) }}">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
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
                        </div>
                    </div></div></div>
            @endif
        @endif

        @if($competition->type === 'singles')
        @if($players && $players->isEmpty())
            <p class="card-text">No players found for this competition.</p>
        @else
            @foreach($games as $date => $gamesOnDate)
            <div class="col-lg-4 mb-2">
                <div class="card card-viking">
                    <div class="card-body">
                        
            <h2>Fixtures & Results </h2>
            <p style="padding-top:10px; padding-bottom:10px; margin-bottom:0px; font-size:1.1rem;">
                {{ \Carbon\Carbon::parse($date)->format('d F Y') }} -  {{ $gamesOnDate->first()->competition_round_id }}
            </p>
                        <table style="width: 100%;">
                            @foreach($gamesOnDate as $game)
                            <tr>

                                    <td>
                                        <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px;">
                                            {{ $game->homePlayer->name }}<br>{{ $game->awayPlayer->name }}
                                        </p>
                                    </td>

                                @if($competition->type === 'league')
                                <td>
                                    <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px; text-align: left; font-size:1.5rem;">
                                        <a style="color:#ffffff;" href="{{ route('games.show', ['game' => $game->id]) }}">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
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
        <a href="{{ route('games.create', ['season_id' => $competition->season->id, 'competition_id' => $competition->id]) }}" class="btn btn-primary">Create Game</a>
        <a href="{{ route('games.edit', ['competition' => $competition->id]) }}" class="btn btn-primary">Edit Games</a>
    </p>
    



</div>
@endsection
