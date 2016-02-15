<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';


if(isset($_GET['idShowType']))
{
	$idShowType = $_GET['idShowType'];
	$selectShowType = $mysqli->query("SELECT * FROM show_type WHERE id='$idShowType'");
	$rowShowType = $selectShowType->fetch_object();

	if(isset($_POST['insert']))
	{
		$show_type 	= $_POST['show_type'];
		$show_price = $_POST['show_price'];
		if($insertVenue = $mysqli->query("UPDATE show_type SET type='$show_type', price='$show_price' WHERE id='$idShowType'") or die($mysqli->error))
		{
			header("Location:flight-type.php");
		}
	}
}
else
{
	header("Location:flight-type.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Edit Tipe Penerbangan</title>
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
			<h3 class="brown-text darken-1">Tambah Tipe Penerbangan</h3>
			<form action="" method="post">
				<div class="row section">
					<div class="input-field col s12 l6 m6">
						<input type="text" name="show_type" id="show_type" value="<?php echo escape($rowShowType->type); ?>" required="required">
						<label for="show_type">Nama Tipe Penerbangan</label>
					</div>
					<div class="input-field col s12 l6 m6">
						<input type="text" name="show_price" id="show_price" value="<?php echo escape($rowShowType->price); ?>" required="required">
						<label for="show_price">Harga</label>
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