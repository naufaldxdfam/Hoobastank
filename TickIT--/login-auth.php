<?php
session_start();
require 'db/connect.php';

if(isset($_SESSION['username']))
{

	$username = $_SESSION['username'];
	$password = $_SESSION['password'];

	$selectUser = $mysqli->prepare("SELECT username, password, firstname FROM user WHERE username=? AND password=?");
	$selectUser->bind_param('ss', $username, $password);
	$selectUser->execute();
	$selectUser->store_result();

	if($selectUser->num_rows)
	{
		$selectUser->bind_result($username_session, $password_session, $firstname_session);
		$selectUser->fetch();
		$statusLogin = 1;
	}
	else
	{
		header("Location:login.php");
	}
}
else
{
	$_SESSION['idShow'] = $_GET['idShow'];
	header("Location:login.php");
}

?>