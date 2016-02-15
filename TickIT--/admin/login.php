<?php
session_start();
require '../db/connect.php';
require '../functions/security.php';

if (isset($_POST['login']))
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if(!empty($username) && !empty($password))
	{
		$selectUser = $mysqli->prepare("SELECT * FROM admin WHERE username=? AND password=?");
		$selectUser->bind_param('ss', $username, $password);
		$selectUser->execute();
		$selectUser->store_result();

		if($selectUser->num_rows)
		{
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;

			header('Location:index.php');
		}
		else
		{
			echo "Nama pengguna atau kata sandi salah.";
		}

	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>TickIT - Masuk</title>
	<link href="../css/google-material-font.css" rel="stylesheet">
	<link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,proje'ction"/>
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="brown darken-1">
	<div class="header">
		<div class="navbar-fixed">
		    <nav class="admin yellow darken-1" role="navigation">
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="brown-text lighten-1 material-icons">menu</i></a>
		    </nav>
		</div>
	</div>
	<div class="main">
		<div class="container">
			<div class="container">
				<div class="card-panel">
					<form action="" method="post">
						<div class="input-field admin">
							<label for="username">Nama pengguna</label>
							<input type="text" name="username" id="username" class="admin">
						</div>
						<div class="input-field admin">
							<label for="password">Kata sandi</label>
							<input type="password" name="password" id="password" class="admin">
						</div>
						<button name="login" class="btn waves-effect brown darken-1">Masuk</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		
	</div>
	<!--  Scripts-->
  	<script src="../js/jquery-2.1.1.min.js"></script>
  	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>
</body>
</html>