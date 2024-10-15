@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a New Team to {{ $season->name }}</h1>

    <form action="{{ route('seasons.teams.store', $season->id) }}" method="POST">
        @csrf

        <!-- Team Name -->
        <div class="form-group">
            <label for="name">Team Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Other fields for the team -->
        <div class="form-group">
            <label for="other_field">Other Field</label>
            <input type="text" name="other_field" id="other_field" class="form-control" value="{{ old('other_field') }}" required>
        </div>

        <!-- Add more fields here as necessary -->

        <button type="submit" class="btn btn-primary">Add Team</button>
    </form>
</div>
@endsection
