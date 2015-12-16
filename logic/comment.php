<?php
include_once("../path/to/config.inc.php"); 

if(isset($_POST['comment'])) {

    $sql_insert_comment = "INSERT INTO comments (name, email, website, comment, song_id) VALUES ('".$_POST['naam']."', '".$_POST['email']."', '".$_POST['website']."', '".$_POST['reactie']."', ".$_POST['song_id'].")";

     mysqli_query($conn , $sql_insert_comment );
    header("location:../index.php?page=detail&song_id=".$_POST['song_id']);

}
