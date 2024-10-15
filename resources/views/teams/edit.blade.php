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

        <!-- Other fields for editing (replace with actual fields) -->
        <div class="form-group">
            <label for="other_field">Other Field</label>
            <input type="text" name="other_field" id="other_field" class="form-control" value="{{ old('other_field', $team->other_field) }}" required>
        </div>

        <!-- Add more fields here as necessary -->

        <button type="submit" class="btn btn-primary">Update Team</button>
    </form>
</div>
@endsection
