<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Daftar Lokasi</title>
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
			<h3 class="brown-text darken-1">Daftar Lokasi</h3>
			<a href="add-venue.php" class="waves-effect waves-circle waves-light btn-floating secondary-content brown">
				<i class="material-icons">add</i>
			</a>
			<table class="highlight">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode</th>
						<th>Bandara</th>
						<th>Lokasi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($selectVenue = $mysqli->query("SELECT * FROM view_venue") or die($mysqli->error))
					{
						if($selectVenue->num_rows)
						{
							$no = 1;
							while($rowVenue = $selectVenue->fetch_object())
							{
								?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo escape($rowVenue->code); ?></td>
									<td><?php echo escape($rowVenue->name); ?></td>
									<td><?php echo escape($rowVenue->location); ?></td>
									<td>
										<a href="edit-venue.php?codeVenue=<?php echo escape($rowVenue->code); ?>"><i class="material-icons">edit</i></a>
									</td>
								</tr>
								<?php
								$no++;
							}
						$selectVenue->free();
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