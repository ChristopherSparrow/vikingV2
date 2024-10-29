@extends('layouts.app')

@section('content')
@php
    $latestSeason = $seasons ? $seasons->sortByDesc('start_date')->first() : null;
@endphp
<div class="container" style="padding-top:10px;">
    @if($latestSeason)
        <h1>the Viking Pool League</h1>
            <div class="row">
                <div class="col-lg-4 mb-2">
                    <div class="card card-viking">
                        <div class="card-body">
                            <p style="padding-top:0px; padding-bottom:0px; margin-bottom:0px;">Latest Edition: {{ $latestSeason->name }}. <br>Starting {{ $latestSeason->start_date->format('d F Y') }}, until {{ $latestSeason->end_date->format('d F Y') }}</p>
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
                                        <a style="color:#ffffff;" href="{{ url('competitions/' . $gamesOnDate->first()->competition->id) }}">{{ $gamesOnDate->first()->competition->name }}</a>: {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
                                    </p>
                                </td>
                            </tr>
                       
                         @foreach($gamesOnDate as $game)
                            <tr>
                                <td>
                                    <p style="padding-top:0px; padding-bottom:10px; margin-bottom:0px;">{{ $game->homeTeam->name }}<br>{{ $game->awayTeam->name }}</p>
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

    @if($latestSeason && $latestSeason->competitions->isNotEmpty())
        <h2>This Season</h2>
        <p>
            @foreach($latestSeason->competitions as $competition)
            
                    <a href="{{ url('competitions/' . $competition->id) }}" class="btn btn-secondary mb-2">{{ $competition->name }}</a>
   
            @endforeach
    </p>
    @else
        <p>No competitions available for the current season.</p>
    @endif
    <p><a href="{{ route('seasons.index') }}" class="btn btn-primary">All seasons</a></p>
</div>
@endsection