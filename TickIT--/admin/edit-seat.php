<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';

if(isset($_GET['idPlane']))
{
	$idPlane = trim($_GET['idPlane']);
	if($selectPlane = $mysqli->query("SELECT * FROM view_plane WHERE id='$idPlane'"))
	{
		$rowPlane = $selectPlane->fetch_object();
	}

	if(isset($_POST['update']))
	{
		(int)$totalSeat = trim($_POST['totalSeat']);

		if($updatePlane = $mysqli->query("UPDATE plane SET seat='$totalSeat' WHERE id='$idPlane';") OR die($mysqli->error))
		{
			if($selectShow = $mysqli->query("SELECT id FROM `show` WHERE id_plane='$idPlane'") or die($mysqli->error))
			{
				while($rowShow = $selectShow->fetch_object())
				{
					if($deleteSeat = $mysqli->query("DELETE FROM seat WHERE id_show='$rowShow->id'") or die($mysqli->error))
					{
						for($i=1;$i<=$totalSeat;$i++)
						{
							$insertSeat = $mysqli->query("INSERT INTO seat(id_show,no,name,status) VALUES('$rowShow->id','$i','HAI','0')");
						}
					}
				}
				header("Location:edit-seat.php?idPlane=$idPlane");
				$selectShow->free();
			}
			
		}
	}
}
else
{
	header("Location:seat.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Sunting Bangku</title>
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
			<h3 class="brown-text darken-1">Sunting Bangku</h3>
			<div class="section">
				<form action="" method="post">
					<div class="row">
						<div class="input-field col s6 m6 l6">
							<label for="idPlane">Kode Pesawat</label>
							<input disabled="disabled" type="text" name="idPlane" id="idPlane" value="<?php echo escape($idPlane); ?>">
						</div>
						<div class="input-field col s6 m6 l6">
							<label for="totalSeat">Jumlah kursi saat ini</label>
							<input type="text" name="totalSeat" id="totalSeat" value="<?php echo escape($rowPlane->seat); ?>">
						</div>
					</div>
					<p class="red-text">Menyunting bangku, berarti mengahapus semua pemesanan di setiap penerbangan pesawat ini sebelumnya! Harap teliti!</p>
					<button type="submit" name="update" class="btn brown lighten-1 waves-effect">Perbarui</button>
				</form>
			</div>
			<div class="row section">
				<?php
				for($i=0;$i<$rowPlane->seat;$i++)
				{
					$mod = $i%3;
					if($i==0 OR ($mod == 0))
					{
						?>
						<div class="col s1 offset-s2 grid-example brown lighten-1"><?php echo $i+1; ?></div>
						<?php
					}
					else
					{
						?>
						<div class="col s1 grid-example brown lighten-1"><?php echo $i+1; ?></div>
						<?php
					}
				}
				?>
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