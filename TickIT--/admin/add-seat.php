<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';

if(isset($_POST['submit']))
{
	$id_plane = $_POST['id_plane'];
	(int)$totalSeat = trim($_POST['totalSeat']);
	if($totalSeat > 0 OR !empty($totalSeat))
	{
		for($i=0;$i<$totalSeat;$i++)
		{
			$insertSeat = $mysqli->query("INSERT INTO seat(id_plane,name) VALUES('$id_plane', '0')");
		}
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Tambah Bangku</title>
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
			<h3 class="brown-text darken-1">Tambah Bangku</h3>
			<form action="" method="post">
			<div class="row">
				<div class="input-field col s12 m6 l6">
					<select name="id_plane">
						<option value="" disabled selected>Pilih Pesawat</option>
						<?php
						if($selectPlane = $mysqli->query("SELECT id,name FROM view_plane"))
						{
							while($rowPlane = $selectPlane->fetch_object())
							{
							?>
								<option value="<?php echo escape($rowPlane->id) ?>"><?php echo escape($rowPlane->name) ?></option>
							<?php
							}
						}
						$selectPlane->free();
						?>
					</select>
					<label>Materialize Select</label>
				</div>
				<div class="input-field col s12 m3 l3">
					<label for="totalSeat">Jumlah kursi</label>
					<input type="text" name="totalSeat" id="totalSeat">
				</div>
				<div class="col s12 m3 l3">
					<button type="submit" name="submit" class="btn waves-effect">Tambah</button>
				</div>
			</div>

			<div class="row">
				<div class="col s1 offset-s2 grid-example teal">1</div>
				<div class="col s1 grid-example teal">1</div>
				<div class="col s1 grid-example teal">1</div>

				<div class="col s1 offset-s2 grid-example teal">1</div>
				<div class="col s1 grid-example teal">1</div>
				<div class="col s1 grid-example teal">1</div>
			</div>
		</div>
	</div>
	<div class="footer">
		
	</div>
	<!--  Scripts-->
  	<script src="../js/jquery-2.1.1.min.js"></script>
  	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
</body>
</html>