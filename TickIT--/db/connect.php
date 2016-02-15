<?php

$mysqli = new mysqli('localhost', 'root', '', 'tickit');
if($mysqli->connect_error)
{
	die("Terjadi kesalahan");
	exit;
}

?>