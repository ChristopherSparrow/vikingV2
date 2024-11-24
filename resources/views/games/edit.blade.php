@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('competitions.show', $competition->id) }}">&lt; Back</a>
    <h1>Edit Games for {{ $competition->name }}</h1>
    @if(in_array($competition->type, ['league', 'team-knockout']))
        @foreach($games->groupBy('date') as $date => $gamesByDate)
            <h2>{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h2>
            @foreach($gamesByDate as $game)
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ route('games.update', $game->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    {{ $game->homeTeam->name }} 
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="home_score" value="{{ $game->home_score }}" class="form-control">
                                </div>
                            </div>
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    {{ $game->awayTeam->name }}
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="away_score" value="{{ $game->away_score }}" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach

        @endforeach
    @endif

    @if(in_array($competition->type, ['singles']))
        @foreach($games->groupBy('date') as $date => $gamesByDate)
            <h2>{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h2>
            @foreach($gamesByDate as $game)
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ route('games.update', $game->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    {{ $game->homePlayer->name }} 
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="home_score" value="{{ $game->home_score }}" class="form-control">
                                </div>
                            </div>
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    {{ $game->awayPlayer->name }}
                                </div>
                                <div class="col-auto">
                                    <input type="text" name="away_score" value="{{ $game->away_score }}" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach

        @endforeach
    @endif

</div>
@endsection