<?php
require 'db/connect.php';
require 'functions/security.php';

if (isset($_POST['register']))
{
	$firstname 			= trim($_POST['firstname']);
	$lastname 			= trim($_POST['lastname']);
	$username 			= trim($_POST['username']);
	$email				= trim($_POST['email']);
	$password 			= trim($_POST['password']);
	$repeat_password	= trim($_POST['repeat_password']);
	$address			= trim($_POST['address']);
	$town				= trim($_POST['town']);
	$country			= trim($_POST['country']);
	$postcode			= trim($_POST['postcode']);

	$selectUser = $mysqli->prepare("SELECT username FROM user WHERE username=?");
	$selectUser->bind_param('s', $username);
	$selectUser->execute();
	$selectUser->store_result();

	if(!$selectUser->num_rows)
	{
		if($password === $repeat_password)
		{
			$inputUser = $mysqli->prepare("INSERT INTO user VALUES(?,?,?,?,?,?,?,?,?)");
			$inputUser->bind_param('sssssssss', $username, $password, $email, $firstname, $lastname, $address, $town, $country, $postcode);
			if($inputUser->execute())
			{
				header("location:login.php");
			}
			else
			{
				"Ada kesalahan saat mendaftar.";
			}
		}
		else
		{
			echo "Password tidak sama.";
		}
	}
	else
	{
		echo "Username tersebut sudah dipakai.";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>TickIT - Daftar</title>
	<link href="css/google-material-font.css" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="teal lighten-1">
	<div class="header">
		<?php
		require 'includes/nav.php';
		?>
	</div>
	<div class="main">
		<div class="container">
			<div class="card-panel">
				<form action="" method="post">
					<div class="row">
						<div class="input-field col s12 m6 l6">
							<label for="firstname">Nama depan</label>
							<input type="text" name="firstname" id="firstname" required="required">
						</div>
						<div class="input-field col s12 m6 l6">
							<label for="lastname">Nama belakang</label>
							<input type="text" name="lastname" id="lastname" required="required">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="username">Nama pengguna</label>
							<input type="text" name="username" id="username" required="required">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="email">Alamat surel</label>
							<input type="text" name="email" id="email" required="required">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6 l6">
							<label for="password">Kata sandi</label>
							<input type="password" name="password" id="password" required="required">
						</div>
						<div class="input-field col s12 m6 l6">
							<label for="repeat_password">Ulangi Kata sandi</label>
							<input type="password" name="repeat_password" id="repeat_password" required="required">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="address">Alamat</label>
							<textarea class="materialize-textarea" id="address" name="address" required="required"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="town">Kota</label>
							<input type="text" name="town" id="town" required="required">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m7 l7">
							<label for="country">Negara</label>
							<input type="text" name="country" id="country" required="required">
						</div>
						<div class="input-field col s12 m5 l5">
							<label for="postcode">Kode pos</label>
							<input type="text" name="postcode" id="postcode" required="required">
						</div>
					</div>
					<button class="btn waves-effect" name="register">Daftar</button>
				</form>
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