<?php 
$db['host'] = '127.0.0.1';
$db['user'] = 'root';
$db['pw'] = '';
$db['name'] = 'top100';

$GLOBALS['conn'] = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);
$conn = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);

?>