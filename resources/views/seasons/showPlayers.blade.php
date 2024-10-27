@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Players in {{ $season->name }}</h1>

    <!-- Add New Player Button -->
    <a href="{{ route('seasons.players.create', $season->id) }}" class="btn btn-primary mb-3">Add New Player</a>

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
                        <li>
                            {{ $player->name }}
                            <!-- Edit Player Button -->
                            <a href="{{ route('seasons.players.edit', ['season' => $season->id, 'player' => $player->id]) }}" class="btn btn-sm btn-secondary ml-2">Edit</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    @endif
</div>
@endsection