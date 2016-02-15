<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';

if(isset($_GET['codeVenue']))
{
	$codeVenue = trim($_GET['codeVenue']);
	if($selectVenue = $mysqli->query("SELECT * FROM view_venue WHERE code='$codeVenue'") or die($mysqli->error))
	{
		$rowVenue = $selectVenue->fetch_object();
	}

	if(isset($_POST['update']))
	{
		$venue_name 	= $_POST['venue_name'];
		$venue_code 	= $_POST['venue_code'];
		$venue_location = $_POST['venue_location']; 
		if($insertVenue = $mysqli->query("UPDATE venue SET code='$venue_code', name='$venue_name', location='$venue_location' WHERE code='$codeVenue'") or die($mysqli->error))
		{
			header("Location:venue.php");
		}
	}
}
else
{
	header("Location:venue.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Sunting Lokasi</title>
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
			<h3 class="brown-text darken-1">Sunting Lokasi</h3>
			<form action="" method="post">
				<div class="row section">
					<div class="input-field col s12 l6 m6">
						<input type="text" name="venue_name" id="venue_name" value="<?php echo escape($rowVenue->name); ?>">
						<label for="venue_name">Nama bandara</label>
					</div>
					<div class="input-field col s12 l6 m6">
						<input type="text" name="venue_code" id="venue_code" value="<?php echo escape($rowVenue->code); ?>">
						<label for="venue_code">Kode bandara</label>
					</div>
					<div class="input-field col s12 l12 m12">
						<input type="text" name="venue_location" id="venue_location" value="<?php echo escape($rowVenue->location); ?>">
						<label for="venue_location">Lokasi</label>
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