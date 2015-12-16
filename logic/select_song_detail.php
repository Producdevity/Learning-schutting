<?php

$day_selected = isset($_GET['days'])?$_GET['days']:date("d");

$sql_select_details = "SELECT * FROM songs WHERE id=".$_GET['song_id'];
$result_details = mysqli_query($conn, $sql_select_details);

$detail = mysqli_fetch_array($result_details);

$sql_count_comments = "SELECT * FROM comments WHERE song_id=".$_GET['song_id'];
$resultC = mysqli_query($conn, $sql_count_comments);
$num_rowsC = mysqli_num_rows($resultC);

                      