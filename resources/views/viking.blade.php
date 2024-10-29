@extends('layouts.app')

@section('content')
@php
    $latestSeason = $seasons ? $seasons->sortByDesc('start_date')->first() : null;
@endphp
<div class="container">
    @if($latestSeason)
        <h1>the Viking Pool League</h1>
        <p>Latest Edition: {{ $latestSeason->name }}. <br>Starting {{ $latestSeason->start_date->format('d F Y') }}, until {{ $latestSeason->end_date->format('d F Y') }}</p>
    @else
        <p>No seasons available.</p>
    @endif
 
    
    @if($upcomingGames->isEmpty())
        <p>No games scheduled in the next 7 days.</p>
    @else
        @foreach($upcomingGames as $date => $gamesOnDate)
            <div class="card mb-3">
                <div class="card-header">Results & Fixtures</div>
                <div class="card-body">
                    <a href="{{ url('competitions/' . $gamesOnDate->first()->competition->id) }}">Competition: {{ $gamesOnDate->first()->competition->name }}</a>

                    <p>{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</p>
                    
                        @foreach($gamesOnDate as $game)
                        <table>
                            <tr><td><p>
                            {{ $game->homeTeam->name }}<br>{{ $game->awayTeam->name }}
                            </p></td>
                            <td><p style="text-align: right;">
                            {{ $game->home_score }}<br>{{ $game->away_score }} 
                        </p>
                        </td>
                        </tr>
                        </table>
                        @endforeach
                    
                </div>
            </div>
        @endforeach
    @endif

    @if($latestSeason && $latestSeason->competitions->isNotEmpty())
        <h2>All competitions in {{ $latestSeason->name }}</h2>
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