@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('seasons.teams.create', $season->id) }}" class="btn btn-success mb-3">Add New Team</a>

    <h1>Teams</h1>
    <p> {{ $season->name }}</p>

    @if($teams->isEmpty())
        <p>No teams found for this season.</p>
    @else

    <div class="row">
        @foreach($teams->sortBy('name') as $team)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $team->name }}</h5>
                        <p>Captain: {{ $team->captain }}<br>
                        Vice Captain: {{ $team->vicecaptain }}</p>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('seasons.teams.edit', ['season' => $season->id, 'team' => $team->id]) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action="{{ route('seasons.teams.destroy', ['season' => $season->id, 'team' => $team->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @endif
</div>
@endsection
