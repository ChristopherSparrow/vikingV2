@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $competition->name }}</h1>
    {{ \Carbon\Carbon::parse($competition->season->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($competition->season->end_date)->format('d F Y') }}
    <br>{{ $competition->season->name }}
    <div class="card">
        <div class="card-body">
            <p class="card-text">

            </p>
    
            {{-- Show teams only if the competition is league or team_knockout --}}
            @if($competition->type === 'league' || $competition->type === 'team_knockout')
                <h5 class="card-title">Teams Participating</h5>
                @if($teams && $teams->isEmpty())
                    <p class="card-text">No teams found for this competition.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($teams as $team)
                            <li class="list-group-item">{{ $team->name }} (Captain: {{ $team->captain }}) (Vice Captain: {{ $team->vicecaptain }})</li>
                        @endforeach
                    </ul>
                @endif
            @endif
        </div>
    </div>

    <a href="{{ route('seasons.index') }}" class="btn btn-primary">Back to Seasons</a>
</div>
@endsection
