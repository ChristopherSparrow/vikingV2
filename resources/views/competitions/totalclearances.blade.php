@extends('layouts.app')


@section('content')
<div class="container"style="padding-top:10px;">
    <p style="margin:0px;">
        <a href="{{ route('competitions.show', $competition->id) }}"> &lt; Back</a>
    </p>
    <h1>{{ $competition->name }} Total Clearances</h1>
    <p>
        {{ $competition->season->name }} <br>
        {{ \Carbon\Carbon::parse($competition->season->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($competition->season->end_date)->format('d F Y') }}
    </p>
    @if($frames->isEmpty())
        <p>No frames found for this competition.</p>
    @else
<!-- Combine all the home_players and awayplayers into a single list -->
<?php   
    $players = array();
    foreach($frames as $frame){
        $players[] = $frame->homeplayer;
        $players[] = $frame->awayplayer; 
    }
    $players = array_unique($players);
    $players = array_values($players);
?>
<div class="col-lg-4 mb-2">
    <div class="card card-viking">
        <div class="card-body">
            <h2>Total Clearances Competition</h2>
    <table class="display">
        <thead>
            <tr>
                <th>Player</th>

                <th>Played</th>
                <th>Eight Balls</th>
            </tr>
        </thead>
        <tbody>
        @foreach($players as $player)
            <?php
            $played = 0;
            foreach($frames as $frame){
                if($frame->homeplayer->id == $player->id || $frame->awayplayer->id == $player->id){
                    $played++;
                }
            }
            ?>
            <?php
                $firstwins = 0;
                foreach($frames as $frame){
                    if($frame->homeplayer->id == $player->id){
                        if($frame->home_score > $frame->away_score && $frame->Home8 == 1){
                            $firstwins++;
                        }
                    }
                    if($frame->awayplayer->id == $player->id){
                        if($frame->away_score > $frame->home_score && $frame->Away8 == 1){
                            $firstwins++;
                        }
                    }
                }   
            ?>

            <tr>
                <td>{{$player->name}}</td>
                <td>{{$played}}</td>
                <td>{{$firstwins}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div></div></div>

<div class="col-lg-4 mb-2">
    <div class="card card-viking">
        <div class="card-body">
    <h2>All Wins</h2>
    <table class="display">
        <thead>
            <tr>
                <th>Player</th>
                <th>Total Played</th>
                <th>Total Wins</th>
            </tr>
        </thead>
        <tbody>
        @foreach($players as $player)



            <?php
                $wins = 0;
                foreach($frames as $frame){
                    if($frame->homeplayer->id == $player->id){
                        if($frame->home_score > $frame->away_score){
                            $wins++;
                        }
                    }
                    if($frame->awayplayer->id == $player->id){
                        if($frame->away_score > $frame->home_score){
                            $wins++;
                        }
                    }
                }   
            ?>


            <tr>
                <td>{{$player->name}}</td>
                <td>{{$played}}</td>
                <td>{{$wins}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div></div></div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
<script>

    $(document).ready(function () {
        $('table.display').DataTable({
            order: [[2, 'desc']],
            paging: false,
            scrollY: 400
        });
    });
            </script>	  
                  
@endsection
