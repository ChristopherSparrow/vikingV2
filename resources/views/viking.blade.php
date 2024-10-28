@extends('layouts.app')

@section('content')

@php
    $latestSeason = $seasons ? $seasons->sortByDesc('start_date')->first() : null;
@endphp

<div class="container">
    @if($latestSeason)
        <h1>Welcome to the Viking Pool League</h1>
        <p>Latest Edition: {{ $latestSeason->name }}.  Starting {{ $latestSeason->start_date->format('d F Y') }}, until {{ $latestSeason->end_date->format('d F Y') }}</p>
        <!-- List all teams, in a bootstrap 5 card -->  
        <div class="accordion" id="teamsAccordion">
            @foreach($latestSeason->teams as $team)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $team->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $team->id }}" aria-expanded="false" aria-controls="collapse{{ $team->id }}">
                            {{ $team->name }}
                        </button>
                    </h2>
                    <div id="collapse{{ $team->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $team->id }}" data-bs-parent="#teamsAccordion">
                        <div class="accordion-body">
                            <p>
                                Captain: {{ $team->captain }}<br>
                                Vice Captain: {{ $team->vicecaptain }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
<!-- Add a link to the seasons index page -->
        <a href="{{ route('seasons.index') }}" class="btn btn-primary">View all seasons</a>
        
        @else
        <p>No seasons available.</p>
    @endif
</div>

@endsection