@extends('layouts.app')

@section('content')
<div class="container"style="padding-top:10px;">
    <h1>{{ $competition->name }}</h1>
    <p>
        {{ $competition->season->name }} <br>
        {{ \Carbon\Carbon::parse($competition->season->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($competition->season->end_date)->format('d F Y') }}
    </p>
    <div class="row">
        @if($competition->type === 'league' || $competition->type === 'team_knockout')
            @if($teams && $teams->isEmpty())
                <p class="card-text">No teams found for this competition.</p>
            @else
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
