@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $competition->name }}</h1>

    <p><strong>Type:</strong> {{ ucfirst($competition->type) }}</p>
    <p><strong>Season:</strong> {{ $competition->season->name }}</p>

    {{-- Show teams only if the competition is league or team_knockout --}}
    @if($competition->type === 'league' || $competition->type === 'team_knockout')
        <h2>Teams Participating</h2>
        @if($teams && $teams->isEmpty())
            <p>No teams found for this competition.</p>
        @else
            <ul>
                @foreach($teams as $team)
                    <li>{{ $team->name }} (Captain: {{ $team->captain }})</li>
                @endforeach
            </ul>
        @endif
    @endif

    <a href="{{ route('seasons.index') }}" class="btn btn-primary">Back to Seasons</a>
</div>
@endsection
