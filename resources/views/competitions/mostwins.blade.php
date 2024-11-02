@extends('layouts.app')

@section('content')
<div class="container">
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
<!-- output the players array as a list -->
    <table class="display">
        
            <thead>
<tr>
            <th>Player</th>
            <th>Total Played</th>
            <th>Total Wins</th>
            <th>First games Played</th>
            <th>First Wins</th>
            
        </tr>
        </thead><tbody>
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
            $firstGamesPlayed = 0;
            foreach($frames as $frame){
                if(
                    ($frame->homeplayer->id == $player->id && $frame->HomeFirst == 1) || 
                    ($frame->awayplayer->id == $player->id && $frame->AwayFirst == 1)
                ){
                    $firstGamesPlayed++;
                }
            }
        ?>
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

            <?php
            $firstwins = 0;
            foreach($frames as $frame){
                if($frame->homeplayer->id == $player->id){
                    if($frame->home_score > $frame->away_score && $frame->HomeFirst == 1){
                        $firstwins++;
                    }
                }
                if($frame->awayplayer->id == $player->id){
                    if($frame->away_score > $frame->home_score && $frame->AwayFirst == 1){
                        $firstwins++;
                    }
                }
            }   
            ?>

            <tr>
                <td>{{$player->name}}</td>
                <td>{{$played}}</td>
                <td>{{$wins}}</td>
                <td>{{$firstGamesPlayed}}</td>
                <td>{{$firstwins}}</td>
            </tr>
        @endforeach
        </tbody></table>


    @endif
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
<script>

    $(document).ready(function () {
        $('table.display').DataTable({
            order: [[4, 'desc']],
        });
    });
            </script>	  
                  
@endsection
