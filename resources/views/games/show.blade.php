@extends('layouts.app')

@section('content')
<div class="container">
    <p style="margin:0px;"><a href="{{ route('competitions.show', $game->competition->id) }}"> &lt; Back</a></p>

    <h1>{{ $game->homeTeam->name }} 
        @if($game->home_score !== null)
            ({{ $game->home_score }})
        @endif
        v 
        @if($game->away_score !== null)
            ({{ $game->away_score }})
        @endif
        {{ $game->awayTeam->name }}
    </h1>
    <p style="margin:0px;"">{{ $game->competition->name }} - {{ \Carbon\Carbon::parse($game->date)->format('F j, Y') }}</p>

    @if($frames->isEmpty())
        <p>No frames found for this game.</p>
    @else
        <table class="table scores">
            <thead>
                <tr style="background-color: #a7b7c7;">
                    <th><i class="bi bi-1-square"></i></th>
                    <th></th>
                    <th><p style="margin:0px; text-align:left;">Home</p></th>
                    <th colspan="2">&nbsp;</th>
                    <th><p style="margin:0px; text-align:right;">Away</p></th>
                    <th></th>
                    <th><p style="margin:0px; text-align:right;"><i class="bi bi-1-square"></i></p></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach($frames as $frame)
                <tr>
                    <td>@if($frame->HomeFirst == 1)<p style="margin:0px; text-align:left;"><i class="bi bi-dot"></i></p>@endif</td>
                    <td>@if($frame->Home8 == 1)<p style="margin:0px; text-align:left;"><i class="bi bi-8-circle-fill"></i></p>@endif</td>
                    <td><p style="margin:0px; text-align:left;">{{ $frame->homePlayer->name }}</p></td>
                    <td>{{ $frame->home_score }}</td>
                    <td>{{ $frame->away_score }}</td>
                    <td ><p style="margin:0px; text-align:right;">{{ $frame->awayPlayer->name }}</p></td>
                    <td>@if($frame->Away8 == 1)<p style="margin:0px; text-align:right;"><i class="bi bi-8-circle-fill"></i>@endif</p></td>
                    <td>@if($frame->AwayFirst == 1)<p style="margin:0px; text-align:right;"><i class="bi bi-dot"></i>@endif</p></td>
                    <td><a href="{{ route('frames.edit', $frame->id) }}"><i class="bi bi-pencil-square"></i></a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Add New Frame</h2>
    <form action="{{ route('frames.store') }}" method="POST">
        @csrf
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <div class="col-lg-4 mb-2">
            <div class="card-body">
                <div class="form-group">
                    <select name="home_player_id" class="form-control" required>
                        <option value="" disabled selected>Home Player</option>
                        @foreach($game->homeTeam->players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="HomeFirst" name="HomeFirst" value="1">
                        <label class="form-check-label" for="HomeFirst">First Game?</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Home8" name="Home8" value="1">
                        <label class="form-check-label" for="Home8">Eight Ball Clearance?</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-2">
            <div class="card-body">
                <div class="form-group">
                    <select name="away_player_id" class="form-control" required>
                        <option value="" disabled selected>Away Player</option>
                        @foreach($game->awayTeam->players as $player)
                            <option value="{{ $player->id }}">{{ $player->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="AwayFirst" name="AwayFirst" value="1">
                        <label class="form-check-label" for="AwayFirst">First Game?</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Away8" name="Away8" value="1">
                        <label class="form-check-label" for="Away8">Eight Ball Clearance?</label>
                    </div>
                </div>
            </div>
        </div>


  
        <div class="form-group">
           <!-- <label for="frame_number">Frame Number</label> -->
            <input type="hidden" name="frame_number" class="form-control" required min="1" max="12" value="{{ $frames->count() + 1 }}" readonly>
        </div>

        <div class="col-lg-4 mb-2">
            <div class="card-body">
            <div class="form-group">
                <label for="winner">Winner</label>
                <div class="btn-group btn-group-toggle d-flex justify-content-between" data-toggle="buttons">
                <label class="btn btn-secondary flex-fill">
                    <input type="radio" name="winner" id="home" autocomplete="off" value="home" checked> Home
                </label>
                <label class="btn btn-secondary flex-fill">
                    <input type="radio" name="winner" id="away" autocomplete="off" value="away"> Away
                </label>
                </div>
            </div>
            </div>
        </div>
        <input type="hidden" name="home_score" id="home_score" value="1">
        <input type="hidden" name="away_score" id="away_score" value="0">

        <script>
            document.querySelectorAll('input[name="winner"]').forEach((elem) => {
                elem.addEventListener("change", function(event) {
                    if (event.target.value === "home") {
                        document.getElementById('home_score').value = 1;
                        document.getElementById('away_score').value = 0;
                    } else {
                        document.getElementById('home_score').value = 0;
                        document.getElementById('away_score').value = 1;
                    }
                });
            });
        </script>



       <p> <button type="submit" class="btn btn-primary">Add Frame</button> </p>
    </form>
</div>
@endsection