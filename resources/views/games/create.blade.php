@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a New Game</h1>
    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <!-- Season -->
        <div class="form-group">
            <label for="season_id">Season</label>
            <select name="season_id" id="season_id" class="form-control" required>
            @foreach($seasons as $season)
                <option value="{{ $season->id }}" {{ (request('season_id', old('season_id')) == $season->id) ? 'selected' : '' }}>
                {{ $season->name }}
                </option>
            @endforeach
            </select>
        </div>
        <!-- Competition -->
        <div class="form-group">
            <label for="competition_id">Competition</label>
            <select name="competition_id" id="competition_id" class="form-control" required>
            @foreach($competitions->where('season_id', request('season_id', old('season_id'))) as $competition)
                <option value="{{ $competition->id }}" {{ (request('competition_id', old('competition_id')) == $competition->id) ? 'selected' : '' }}>
                {{ $competition->name }}
                </option>
            @endforeach
            </select>
        </div>


    @php
        $selectedCompetition = $competitions->where('id', request('competition_id', old('competition_id')))->first();
    @endphp
    
    @if($selectedCompetition && in_array($selectedCompetition->type, ['league']))
        <!-- Home Team -->
        <div class="form-group">
            <label for="home_team_id">Home Team</label>
            <select name="home_team_id" id="home_team_id" class="form-control" required>
            @foreach($teams->where('season_id', request('season_id', old('season_id'))) as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
            </select>
        </div>
        <!-- Away Team -->
        <div class="form-group">
            <label for="away_team_id">Away Team</label>
            <select name="away_team_id" id="away_team_id" class="form-control" required>
            @foreach($teams->where('season_id', request('season_id', old('season_id'))) as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
            </select>
        </div>
   @endif
   @if($selectedCompetition && in_array($selectedCompetition->type, ['team_knockout']))
   <div class="form-group">
        <label for="competition_round_id">Competition Round</label>
        <select name="competition_round_id" id="competition_round_id" class="form-control" required>
            <option value="Preliminary Round">Preliminary</option>
            <option value="First Round">First Round</option> 
            <option value="Second Round">Second Round</option>
            <option value="Third Round">Third Round</option>
            <option value="Quarter Finals">Quarter</option>
            <option value="Semi Finals">Semi</option>
            <option value="Final">Final</option>
        </select>
    </div>
    <div class="form-group">
        <label for="location_name">Location</label>
        <input type="text" name="location_name" id="location_name" class="form-control">
    </div>
   <!-- Home Team -->
   <div class="form-group">
       <label for="home_team_id">Home Team</label>
       <select name="home_team_id" id="home_team_id" class="form-control" required>
       @foreach($teams->where('season_id', request('season_id', old('season_id'))) as $team)
       <option value="{{ $team->id }}">{{ $team->name }}</option>
       @endforeach
       </select>
   </div>
   <!-- Away Team -->
   <div class="form-group">
       <label for="away_team_id">Away Team</label>
       <select name="away_team_id" id="away_team_id" class="form-control" required>
       @foreach($teams->where('season_id', request('season_id', old('season_id'))) as $team)
       <option value="{{ $team->id }}">{{ $team->name }}</option>
       @endforeach
       </select>
   </div>
@endif
   @if($selectedCompetition && in_array($selectedCompetition->type, ['singles']))

           <!-- Competetion Round -->
              <div class="form-group">
                    <label for="competition_round_id">Competition Round</label>
                    <select name="competition_round_id" id="competition_round_id" class="form-control" required>
                    
                        <option value="Preliminary Round (Best of 5)">Preliminary</option>
                        <option value="First Round (Best of 5)">First Round</option> 
                        <option value="Second Round (Best of 5)">Second Round</option>
                        <option value="Third Round (Best of 5)">Third Round</option>
                        <option value="Quarter Finals (Best of 7)">Quarter</option>
                        <option value="Semi Finals (Best of 5)">Semi</option>
                        <option value="Final (Best of 5)">Final</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="location_name">Location</label>
                    <input type="text" name="location_name" id="location_name" class="form-control">
                </div>

     
            @if($selectedCompetition && in_array($selectedCompetition->type, ['singles']))
            <!-- Home Player -->
            <div class="form-group">
                <label for="home_player_id">Home Player</label>
                <select name="home_player_id" id="home_player_id" class="form-control" required>
                    <option value="" disabled selected>Select Home Player</option>
                    @foreach($players->filter(function($player) use ($teams) {
                        return $teams->where('season_id', request('season_id', old('season_id')))
                                     ->pluck('id')
                                     ->contains($player->team_id);
                    })->sortBy('name') as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Away Player -->
            <div class="form-group">
                <label for="away_player_id">Away Player</label>
                <select name="away_player_id" id="away_player_id" class="form-control" required>
                    <option value="" disabled selected>Select Away Player</option>
                    @foreach($players->filter(function($player) use ($teams) {
                        return $teams->where('season_id', request('season_id', old('season_id')))
                                     ->pluck('id')
                                     ->contains($player->team_id);
                    })->sortBy('name') as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
    @endif
        <!-- Date -->
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <!-- Home Score -->
        <div class="form-group">
            <label for="home_score">Home Score</label>
            <input type="number" name="home_score" id="home_score" class="form-control">
        </div>
        <!-- Away Score -->
        <div class="form-group">
            <label for="away_score">Away Score</label>
            <input type="number" name="away_score" id="away_score" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Game</button>
    </form>
</div>
@endsection