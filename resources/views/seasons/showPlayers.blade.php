@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Players in {{ $season->name }}</h1>

    <!-- Add New Player Button -->
    <a href="{{ route('seasons.players.create', $season->id) }}" class="btn btn-primary mb-3">Add New Player</a>

    @if($teams->isEmpty())
        <p>No players found for this season.</p>
    @else
    <div class="row">
        @foreach($teams->sortBy('name') as $team)

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $team->name }}</h3>
                    </div>
                    <div class="card-body">
                        @if($team->players->isEmpty())
                            <p>No players in this team.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($team->players as $player)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $player->name }}
                                        <a href="{{ route('seasons.players.edit', ['season' => $season->id, 'player' => $player->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach
    </div>    

    @endif
</div>
@endsection