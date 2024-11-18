@extends('layouts.app')

@php
    $teams = $teams ?? collect();
@endphp

@section('content')
@php
    $latestSeason = $seasons ? $seasons->sortByDesc('start_date')->first() : null;
@endphp
<div class="container" style="padding-top:10px;">
    @if($latestSeason)
        <h1>the <strong>Viking Pool League</strong></h1>
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <div class="card card-viking">
                        <div class="card-body">
                            <h2>Latest News</h2>
                            <!-- Create a table that holds an image, a news headline, a sentence of text and a published date -->
                            <table class="table" style="width:100%;">
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/logo.png') }}" alt="News" style="width:100px;">
                                    </td>
                                    <td style="padding-left: 10px;;">
                                        <h3 style="margin: 0;">Latest News</h3>
                                        <p style="margin: 0; line-height: 1;">Read the latest news from the Viking Pool League.</p>
                                        <p style="margin: 0; text-align: right;">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                                    </td>
                                </tr>  
                            </table>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-4 mb-2">
                    <div class="card card-viking">
                        <div class="card-body">
                            <h2>League Table</h2>

<!-- Create a league table of the games for the latestseason -->

                            @if($teams && $teams->isEmpty())
                                <p>No teams found for this competition.</p>
                            @else

         
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
                                        $played = $team->games->where('season_id', $latestSeason->id)->where('competition_id', 1)->count();
                                        $won = $team->games->filter(function($game) use ($team, $latestSeason) {
                                            return $game->season_id == $latestSeason->id && (
                                                ($game->home_team_id == $team->id && $game->home_score > $game->away_score) ||
                                                ($game->away_team_id == $team->id && $game->away_score > $game->home_score)
                                            );
                                        })->count();
                                        $drawn = $team->games->filter(function($game) use ($latestSeason) {
                                            return $game->season_id == $latestSeason->id && $game->home_score == $game->away_score;
                                        })->count();
                                        $lost = $played - $won - $drawn;
                                        $points = $team->games->where('season_id', $latestSeason->id)->sum(function($game) use ($team) {
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
                            @endif

                        </div>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <p>No seasons available.</p>
                </div>

    @endif
 
    
    @if($upcomingGames->isEmpty())
        <p>No games scheduled in the next 7 days.</p>
    @else

        <div class="col-lg-4 mb-2">
                <div class="card card-viking">
                    <div class="card-body">
					    <div class="card-title d-flex justify-content-between align-items-center" style="margin:0px;">
						    <div class="d-flex align-items-center"><strong>Results & Fixtures</strong></div>            
                        </div>
                        @foreach($upcomingGames as $date => $gamesOnDate)
                        

                        <table style="width: 100%;">
                            <tr>
                                <td colspsan="2">
                                    <p style="padding-top:10px; padding-bottom:10px; margin-bottom:0px; font-size:1.1rem;">
                                        <a style="color:#ffffff;" href="{{ url('competitions/' . $gamesOnDate->sortBy('date')->first()->competition->id) }}">
                                            {{ $gamesOnDate->sortBy('date')->first()->competition->name ?? 'N/A' }}{{ $gamesOnDate->sortBy('date')->first()->competition_round_id ? ', ' . $gamesOnDate->sortBy('date')->first()->competition_round_id : '' }} <br> {{ \Carbon\Carbon::parse($date)->format('d F Y') }}</a>
                                        
                                    </p>
                                </td>
                            </tr>
                       
                         @foreach($gamesOnDate as $game)
                            <tr>
                                <td>
                                    <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px;">
                                        {{ $game->homeTeam->name ?? $game->homePlayer->name ?? 'N/A' }}<br>
                                        {{ $game->awayTeam->name ?? $game->awayPlayer->name ?? 'N/A' }}
                                    </p>
                                </td>
                                <td>
                                    <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px; text-align: right;">{{ $game->home_score }}<br>{{ $game->away_score }}</p>
                                </td>
                            </tr>
                        
                        @endforeach
                        </table>
                    @endforeach
                    </div>

                </div>

            </div>

            </div>
    @endif

    @if($latestSeason && $latestSeason->competitions && $latestSeason->competitions->isNotEmpty())
        <h2>This Season</h2>
            <p>
                {{ $latestSeason->name }} - {{ $latestSeason->start_date->format('d F Y') }}, until {{ $latestSeason->end_date->format('d F Y') }} <br>
            </p>
            <p>
                @foreach($latestSeason->competitions as $competition)
                    <a href="{{ url('competitions/' . $competition->id) }}" class="btn btn-secondary mb-2">{{ $competition->name }}</a>
                @endforeach
                    <a href="{{ route('seasons.index') }}" class="btn btn-primary mb-2">All seasons</a>
            </p>
    @else
        <p>No competitions available for the current season.</p>
    @endif

</div>
@endsection