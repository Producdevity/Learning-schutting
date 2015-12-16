<?php
if(!isset($_GET['days'])){
        header("location:index.php?days=".date("d"));
}

if($_GET['days'] > date("d")){
    header("location:index.php?days=".date("d"));
}
   // $sql_select_songs = "SELECT * FROM songs ORDER BY id"; 
//$result_rq = mysqli_query($conn, $sql_select_songs);

$day_selected = isset($_GET['days'])?$_GET['days']:date("d");
    
$maxItems = 4;
$endSelect = ($day_selected - 1) * $maxItems;

$sql_select_songs = "SELECT * FROM songs ORDER BY id DESC LIMIT " .$endSelect. "," . $maxItems;
$result_songs = mysqli_query($conn, $sql_select_songs);


//$result = resultToArray($result_db);
