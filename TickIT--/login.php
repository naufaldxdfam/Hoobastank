<?php
session_start();
require 'db/connect.php';
require 'functions/security.php';
require 'session.php';



if (isset($_POST['login']))
{	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if(!empty($username) && !empty($password))
	{
		$selectUser = $mysqli->prepare("SELECT * FROM user WHERE username=? AND password=?");
		$selectUser->bind_param('ss', $username, $password);
		$selectUser->execute();
		$selectUser->store_result();

		if($selectUser->num_rows)
		{
			$_SESSION['username'] = $username;
			$_SESSION['password'] =  $password;
			if(isset($_SESSION['idShow']))
			{
				$idShow = $_SESSION['idShow'];
				header("Location:book.php?idShow=$idShow");
			}
			else
			{
				header('Location:user.php');
			}
			
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
	<link href="css/google-material-font.css" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="teal lighten-1">
	<?php
	require 'includes/nav.php';
	?>
	<div class="main">
		<div class="container">
			<div class="container">
				<div class="card-panel">
					<form action="" method="post">
						<div class="input-field">
							<label for="username">Nama pengguna</label>
							<input type="text" name="username" id="username">
						</div>
						<div class="input-field">
							<label for="password">Kata sandi</label>
							<input type="password" name="password" id="password">
						</div>
						<button name="login" class="btn waves-effect">Masuk</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		
	</div>
	<!--  Scripts-->
  	<script src="js/jquery-2.1.1.min.js"></script>
  	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>
</body>
</html>