@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seasons</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seasons as $season)
            <tr>
                <td>{{ $season->id }}</td>
                <td>{{ $season->name }}</td>
                <td>{{ $season->start_date }}</td>
                <td>{{ $season->end_date }}</td>
                <td>{{ ucfirst($season->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
