<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Tipe Penerbangan</title>
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
			<h3 class="brown-text darken-1">Tipe Penerbangan</h3>
			<a href="add-ticket-type.php" class="waves-effect waves-circle waves-light btn-floating secondary-content brown">
				<i class="material-icons">add</i>
			</a>
			<table class="highlight">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tipe</th>
						<th>Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($selectShowType = $mysqli->query("SELECT * FROM view_show_type") or die($mysqli->error))
					{
						if($selectShowType->num_rows)
						{
							$no = 1;
							while($rowShowType = $selectShowType->fetch_object())
							{
								?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo escape($rowShowType->type); ?></td>
									<td><?php echo escape($rowShowType->price); ?></td>
									<td>
										<a href="edit-schedule-type.php?idShowType=<?php echo escape($rowShowType->id); ?>"><i class="material-icons">edit</i></a>
									</td>
								</tr>
								<?php
								$no++;
							}
						$selectShowType->free();
						}
					}
					?>
				</tbody>
			</table>
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