<?php
require '../db/connect.php';
require '../session.php';
require '../functions/security.php';

$updateUser = $mysqli->prepare("SELECT * FROM user WHERE username = ?");
$updateUser->bind_param('s',$username_session);
$updateUser->execute();
$updateUser->bind_result($username, $password, $email, $firstname, $lastname, $address, $town, $country, $postcode);
$updateUser->fetch();
$updateUser->close();

if(isset($_POST['update']))
{
	$validation_password	= trim($_POST['validation_password']);

	if($validation_password === $password_session)
	{
		$firstname 				= trim($_POST['firstname']);
		$lastname 				= trim($_POST['lastname']);
		$username 				= trim($_POST['username']);
		$email					= trim($_POST['email']);
		$password 				= trim($_POST['password']);
		$repeat_password		= trim($_POST['repeat_password']);
		$address				= trim($_POST['address']);
		$town					= trim($_POST['town']);
		$country				= trim($_POST['country']);
		$postcode				= trim($_POST['postcode']);

		$selectUser = $mysqli->prepare("SELECT username FROM user WHERE username=? AND username <> ? ");
		$selectUser->bind_param('ss', $username, $username_session);
		$selectUser->execute();
		$selectUser->store_result();

		if($selectUser->num_rows)
		{
			echo "Username tersebut sudah dipakai";
		}
		else
		{
			if(!empty($password))
			{
				if($password === $repeat_password)
				{
					$updateUser = $mysqli->prepare("UPDATE user SET
						username 	= ?,
						password 	= ?,
						email 		= ?,
						firstname	= ?,
						lastname	= ?,
						address 	= ?,
						town		= ?,
						country 	= ?,
						postcode	= ?
						
						WHERE username = ?
						");
					$updateUser->bind_param('ssssssssss',
						$username,
						$password,
						$email,
						$firstname,
						$lastname,
						$address,
						$town,
						$country,
						$postcode,
						$username_session);
					if($updateUser->execute())
					{
						header("Location:edit-profile.php");
					}
					else
					{
						echo "Gagal menyimpan1";
					}
					$updateUser->exit();
				}
			}
			else
			{
				if($password === $repeat_password)
				{
					$updateUser = $mysqli->prepare("UPDATE user SET
						username 	= ?,
						email 		= ?,
						firstname	= ?,
						lastname	= ?,
						address 	= ?,
						town		= ?,
						country 	= ?,
						postcode	= ?
						
						WHERE username = ?
						");
					$updateUser->bind_param('sssssssss',
						$username,
						$email,
						$firstname,
						$lastname,
						$address,
						$town,
						$country,
						$postcode,
						$username_session);
					if($updateUser->execute())
					{
						header("Location:edit-profile.php");
					}
					else
					{
						echo "Gagal menyimpan2";
					}
					$updateUser->exit();
				}
			}
		}
	}


	
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>TickIT - Daftar</title>
	<link href="../css/google-material-font.css" rel="stylesheet">
	<link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="teal lighten-1">
	<div class="header">
		<div class="navbar-fixed">
		    <nav class="white" role="navigation">
		    	<div class="nav-wrapper container">
		        	<a id="logo-container" href="index.php" class="brand-logo"><img alt="logo" src="logo-24i.png" class="center" width="40px" height="40px"></a>
		        	<ul class="right hide-on-med-and-down">
		          		<li><a href="#"><?php echo $firstname_session ?></a></li>
		          		<li><a href="#">Keluar</a></li>
		        	</ul>


		        	<ul id="nav-mobile" class="side-nav">
		          		<li><a href="#"><?php echo $firstname_session ?></a></li>
		          		<li><a href="#">Keluar</a></li>
		        	</ul>
		        	<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		      	</div>
		    </nav>
		</div>
	</div>
	<div class="main">
		<div class="container">
			<div class="card-panel">
				<form action="" method="post">
					<div class="row">
						<div class="input-field col s12 m6 l6">
							<label for="firstname">Nama depan</label>
							<input type="text" name="firstname" id="firstname" required="required" value="<?php echo escape($firstname) ?>">
						</div>
						<div class="input-field col s12 m6 l6">
							<label for="lastname">Nama belakang</label>
							<input type="text" name="lastname" id="lastname" required="required" value="<?php echo escape($lastname) ?>">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="username">Nama pengguna</label>
							<input type="text" name="username" id="username" required="required" value="<?php echo escape($username) ?>">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="email">Alamat surel</label>
							<input type="text" name="email" id="email" required="required"  value="<?php echo escape($email) ?>">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6 l6">
							<label for="password">Kata sandi baru (opsional)</label>
							<input type="password" name="password" id="password">
						</div>
						<div class="input-field col s12 m6 l6">
							<label for="repeat_password">Ulangi Kata sandi baru</label>
							<input type="password" name="repeat_password" id="repeat_password">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="address">Alamat</label>
							<textarea class="materialize-textarea" id="address" name="address" required="required"><?php echo escape($address) ?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m12 l12">
							<label for="town">Kota</label>
							<input type="text" name="town" id="town" required="required" value="<?php echo escape($town) ?>">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m7 l7">
							<label for="country">Negara</label>
							<input type="text" name="country" id="country" required="required" value="<?php echo escape($country) ?>">
						</div>
						<div class="input-field col s12 m5 l5">
							<label for="postcode">Kode pos</label>
							<input type="text" name="postcode" id="postcode" required="required" value="<?php echo escape($postcode) ?>">
						</div>
					</div>
					<div class="divider">a</div>
						<div class="input-field">
							<p class="teal-text lighten-2">Harap masukan kata sandi saat ini untuk melanjutkan</p>
						</div>
						<div class="input-field">
							<label for="validation_password">Kata sandi</label>
							<input type="password" name="validation_password" id="validation_password" required="required">
						</div>
					<button class="btn waves-effect" name="update">Perbarui</button>
				</form>
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