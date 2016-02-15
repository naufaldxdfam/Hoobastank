<?php
session_start();
if(isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];

	$selectUser = $mysqli->prepare("SELECT username, password, name FROM admin WHERE username=? AND password=?");
	$selectUser->bind_param('ss', $username, $password);
	$selectUser->execute();
	$selectUser->store_result();

	if($selectUser->num_rows)
	{
		$selectUser->bind_result($username_session_admin, $password_session_admin, $name_session_admin);
		$selectUser->fetch();
		$statusLogin = 1;
	}
	else
	{
		$statusLogin = 0;
		header("Location:login.php");
	}
}
else
{

	$statusLogin = 0;
	header("Location:login.php");
}

?>