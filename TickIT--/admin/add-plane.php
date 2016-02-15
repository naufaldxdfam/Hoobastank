<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
require '../functions/formatingid.php';

if(isset($_POST['insert']))
{
	$plane_name 	= $_POST['plane_name'];
	$plane_id = format('plane');
	if($insertVenue = $mysqli->query("INSERT INTO plane VALUES('$plane_id', '$plane_name', '0')") or die($mysqli->error))
	{
		header("Location:edit-seat.php?idPlane=$plane_id");
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Tambah Pesawat</title>
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
			<h3 class="brown-text darken-1">Tambah Pesawat</h3>
			<form action="" method="post">
				<div class="row section">
					<div class="input-field col s12 l6 m6">
						<input type="text" name="plane_name" id="plane_name">
						<label for="plane_name">Nama Pesawat</label>
					</div>
					</div>
					<button type="submit" class="btn waves-effect brown lighten-1" name="insert">Simpan</button>	
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