<?php

$song_id = $_GET['song_id'];

if($song_id < (date("d") * 4)){
    $song_id --;
}


$sql_select_details = "SELECT * FROM songs WHERE id=".$song_id;
$result_details_back = mysqli_query($conn, $sql_select_details); //back
$song_back = mysqli_fetch_array($result_details_back);


if($song_id < (date("d") * 4)){
    $song_id = $song_id +2;
}


$sql_select_details = "SELECT * FROM songs WHERE id=".$song_id;
$result_details_next = mysqli_query($conn, $sql_select_details); //next
$song_next = mysqli_fetch_array($result_details_next);