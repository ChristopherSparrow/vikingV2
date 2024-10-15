@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Teams in {{ $season->name }}</h1>

    @if($teams->isEmpty())
        <p>No teams found for this season.</p>
    @else
        <ul>
            @foreach($teams as $team)
                <li>{{ $team->name }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
