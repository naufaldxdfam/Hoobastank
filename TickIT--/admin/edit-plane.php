<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';

if(isset($_GET['idPlane']))
{
	$idPlane = trim($_GET['idPlane']);
	if($selectPlane = $mysqli->query("SELECT * FROM view_plane WHERE id='$idPlane'") or die($mysqli->error))
	{
		$rowPlane = $selectPlane->fetch_object();
	}

	if(isset($_POST['update']))
	{
		$plane_name 	= $_POST['plane_name'];
		if($insertVenue = $mysqli->query("UPDATE plane SET name='$plane_name' WHERE id='$idPlane'") or die($mysqli->error))
		{
			header("Location:plane.php");
		}
	}
}
else
{
	header("Location:plane.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Sunting Pesawat</title>
	<link href="../css/google-material-font.css" rel="stylesheet">
	<link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="">
	<?php
	require 'includes/side-nav.php';
	?>

	<div class="header">
		<div class="navbar-fixed">
		    <nav class="admin yellow darken-1" role="navigation">
				<a href="#" data-activates="slide-out" class="button-collapse"><i class="brown-text lighten-1 material-icons">menu</i></a>
		    </nav>
		</div>
	</div>
	<div class="main">
		<div class="container">
			<h3 class="brown-text darken-1">Sunting Pesawat</h3>
			<form action="" method="post">
				<div class="row section">
					<div class="input-field col s12 l6 m6">
						<input disabled="disabled" type="text" name="plane_code" id="plane_code" value="<?php echo escape($rowPlane->id); ?>">
						<label for="plane_code">Kode Pesawat</label>
					</div>
					<div class="input-field col s12 l6 m6">
						<input type="text" name="plane_name" id="plane_name" value="<?php echo escape($rowPlane->name); ?>">
						<label for="plane_name">Nama Pesawat</label>
					</div>
					</div>
					<button type="submit" class="btn waves-effect brown lighten-1" name="update">Simpan</button>	
				</div>
			</form>
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