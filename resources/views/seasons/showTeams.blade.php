@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('seasons.teams.create', $season->id) }}" class="btn btn-success mb-3">Add New Team</a>

    <h1>Teams in {{ $season->name }}</h1>

    @if($teams->isEmpty())
        <p>No teams found for this season.</p>
    @else
        <ul>
            @foreach($teams as $team)
                <li>{{ $team->name }}</li> <a href="{{ route('seasons.teams.edit', ['season' => $season->id, 'team' => $team->id]) }}" class="btn btn-warning btn-sm">Edit</a>
             
            @endforeach
        </ul>
    @endif
</div>
@endsection
