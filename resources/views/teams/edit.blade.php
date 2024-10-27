@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Team: {{ $team->name }}</h1>

    <form action="{{ route('seasons.teams.update', ['season' => $season->id, 'team' => $team->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Team Name -->
        <div class="form-group">
            <label for="name">Team Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $team->name) }}" required>
        </div>

        <!-- Team Captain -->
        <div class="form-group">
            <label for="captain">Captain</label>
            <input type="text" name="captain" id="captain" class="form-control" value="{{ old('captain', $team->captain) }}" required>
        </div>

        <!-- Vice Captain -->
        <div class="form-group">
        <label for="vicecaptain">Vice Captain</label>
        <input type="text" name="vicecaptain" id="vicecaptain" class="form-control" value="{{ old('vicecaptain', $team->vicecaptain) }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Update Team</button>
        <a href="{{ route('seasons.teams', $season->id) }}">Back</button> 
    </form>
</div>
@endsection