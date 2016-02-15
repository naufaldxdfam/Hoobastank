<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Daftar Pesawat</title>
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
			<h3 class="brown-text darken-1">Daftar Pesawat</h3>
			<a href="add-plane.php" class="waves-effect waves-circle waves-light btn-floating secondary-content brown">
				<i class="material-icons">add</i>
			</a>
			<table class="highlight">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode</th>
						<th>Nama Pesawat</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($selectPlane = $mysqli->query("SELECT * FROM view_plane") or die($mysqli->error))
					{
						if($selectPlane->num_rows)
						{
							$no = 1;
							while($rowPlane = $selectPlane->fetch_object())
							{
								?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo escape($rowPlane->id); ?></td>
									<td><?php echo escape($rowPlane->name); ?></td>
									<td>
										<a href="edit-plane.php?idPlane=<?php echo escape($rowPlane->id); ?>"><i class="material-icons">edit</i></a>
									</td>
								</tr>
								<?php
								$no++;
							}
						$selectPlane->free();
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
	<script type="text/javascript">
		$(document).ready(function(){
			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
			$('.modal-trigger').leanModal();
		});
	</script>
</body>
</html>