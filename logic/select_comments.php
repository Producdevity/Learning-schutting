<?php


$sql_select_comments = "SELECT * FROM comments WHERE song_id=".$_GET['song_id']." ORDER BY date ";
$result_comments = mysqli_query($conn, $sql_select_comments);


