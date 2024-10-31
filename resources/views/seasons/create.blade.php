@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Season</h1>
    <form action="{{ route('seasons.store') }}" method="POST">
        @csrf
        <!-- Season Name -->
        <div class="form-group">
            <label for="name">Season Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <!-- Start Date -->
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        
        <!-- End Date -->
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        
        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="upcoming">Upcoming</option>
                <option value="ongoing">Ongoing</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Season</button>
    </form>
</div>
@endsection