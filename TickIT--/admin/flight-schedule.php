<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Jadwal Penerbangan</title>
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
			<h3 class="brown-text darken-1">Jadwal Penerbangan</h3>
			<a href="add-flight.php" class="waves-effect waves-circle waves-light btn-floating secondary-content brown">
				<i class="material-icons">add</i>
			</a>
			<table class="highlight">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama</th>
						<th>Keberangkatan</th>
						<th>Tujuan</th>
						<th>Kode Pesawat</th>
						<th>Waktu Kbrngktn</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($selectShow = $mysqli->query("SELECT * FROM view_show ORDER BY show_id ASC") or die($mysqli->error))
					{
						if($selectShow->num_rows)
						{
							while($rowShow = $selectShow->fetch_object())
							{
								?>
								<div id="<?php echo escape($rowShow->show_id); ?>" class="modal modal-fixed-footer">
									<div class="modal-content">
										<h4>Penerbangan #<?php echo escape($rowShow->show_id); ?></h4>
										<div>Nomor Pesawat : <b><?php echo escape($rowShow->id_plane); ?></b></div>
										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Rute</h5>
										<div>Keberangkatan	: <b><?php echo escape($rowShow->venue_name_departure. " - ".$rowShow->venue_location_departure." (".$rowShow->code_venue_departure.")") ?></b></div>
										<div>Tujuan			: <b><?php echo escape($rowShow->venue_name_destination. " - ".$rowShow->venue_location_destination." (".$rowShow->code_venue_destination.")") ?></b></div>
										<div>Waktu Keberangkatan : <b><?php echo escape($rowShow->departure_time); ?></b></div>
										<div>Waktu Tiba : <b><?php echo escape($rowShow->arrive_time); ?></b></div>

										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Harga dan Tipe Penerbangan</h5>
										<div>Harga dasar : <b><?php echo escape($rowShow->default_price); ?></b></div>
										<div>Tipe penerbangan : <b><?php echo escape($rowShow->show_type); ?></b></div>

										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Bangku</h5>
										<div class="row section">
											<?php
											if($selectSeat = $mysqli->query("SELECT * FROM view_seat WHERE id_show='$rowShow->show_id'") or die($mysqli->error))
											{
												if($numSeat = $selectSeat->num_rows)
												{
													$i = 0;
													while($rowSeat = $selectSeat->fetch_object())
													{
														$mod = $i%3;
														if($rowSeat->status == 0)
														{
															if($i==0 OR ($mod == 0))
															{
																?>
																<div class="col s1 offset-s2 grid-example teal"><?php echo $i+1; ?></div>
																<?php
															}
															else
															{
																?>
																<div class="col s1 grid-example teal"><?php echo $i+1; ?></div>
																<?php
															}
														}
														else
														{
															if($i==0 OR ($mod == 0))
															{
																?>
																<div class="col s1 offset-s2 grid-example red darken-1"><?php echo $i+1; ?></div>
																<?php
															}
															else
															{
																?>
																<div class="col s1 grid-example red darken-1"><?php echo $i+1; ?></div>
																<?php
															}
														}
														$i++;
													}
												}
												$selectSeat->free();
											}
											?>
										</div>
									</div>
										<div class="modal-footer">
										<a href="#!" class="modal-action modal-close waves-effect waves-yellow btn-flat ">Tutup</a>
										<a href="edit-flight.php?idShow=<?php echo escape($rowShow->show_id); ?>" class="modal-action waves-effect waves-yellow btn-flat">Edit</a>
									</div>
								</div>

								<tr data-target="<?php echo escape($rowShow->show_id); ?>" class="modal-trigger">
									<td><?php echo escape($rowShow->show_id); ?></td>
									<td><?php echo escape($rowShow->show_name); ?></td>
									<td><?php echo escape($rowShow->venue_name_departure); ?></td>
									<td><?php echo escape($rowShow->venue_name_destination); ?></td>
									<td><?php echo escape($rowShow->id_plane); ?></td>
									<td><?php echo escape($rowShow->departure_time); ?></td>
									<td><i class="material-icons">visibility</i></td>
								</tr>
								<?php
							}
						$selectShow->free();
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