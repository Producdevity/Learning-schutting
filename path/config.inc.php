<?php 
$db['host'] = 'mysql.hostinger.nl';
$db['user'] = 'u117922799_top';
$db['pw'] = 'Vechtsport420';
$db['name'] = 'u117922799_top';

$conn = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);
$GLOBALS['conn'] = mysqli_connect($db['host'],$db['user'],$db['pw'],$db['name']);
?>