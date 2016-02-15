<?php
session_start();

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
		$statusLogin = 0;
	}
}
else
{
	$statusLogin = 0;
}

?>