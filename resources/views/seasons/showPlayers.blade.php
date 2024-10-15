@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Players in {{ $season->name }}</h1>

    @if($teams->isEmpty())
        <p>No players found for this season.</p>
    @else
        @foreach($teams as $team)
            <h3>{{ $team->name }}</h3>
            @if($team->players->isEmpty())
                <p>No players in this team.</p>
            @else
                <ul>
                    @foreach($team->players as $player)
                        <li>{{ $player->name }}</li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    @endif
</div>
@endsection
