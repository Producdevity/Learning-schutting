<?php

$sql_select_all_songs = "SELECT * FROM songs ORDER BY id DESC";
$result_songs = mysqli_query($conn, $sql_select_all_songs);