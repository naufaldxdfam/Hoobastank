<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Daftar Pemesanan</title>
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
			<h3 class="brown-text darken-1">Daftar Pemesanan</h3>
			<table class="highlight">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nama</th>
						<th>No. Kbrngktn</th>
						<th>Rute</th>
						<th>Kode Pesawat</th>
						<th>Waktu Kbrngktn</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($selectBook = $mysqli->query("SELECT * FROM view_book") or die($mysqli->error))
					{
						if($selectBook->num_rows)
						{
							while($rowBook = $selectBook->fetch_object())
							{
								?>

								<div id="<?php echo escape($rowBook->id_booking); ?>" class="modal modal-fixed-footer">
									<div class="modal-content">
										<h4>Pemesanan #<?php echo escape($rowBook->id_booking); ?></h4>
										<div>Nama Pemesan : <b><?php echo escape($rowBook->firstname." ".$rowBook->lastname); ?></b></div>
										<div>Waktu Memesan : <b><?php echo escape($rowBook->booking_time); ?></b></div>

										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Penerbangan</h5>
										<div>Nomor Penerbangan : <b><?php echo escape($rowBook->id_show); ?></b></div>
										<div>Nomor Pesawat : <b><?php echo escape($rowBook->id_plane); ?></b></div>
										<div>Keberangkatan	: <b><?php echo escape($rowBook->venue_departure_name. " - ".$rowBook->venue_departure_location." (".$rowBook->code_venue_departure.")") ?></b></div>
										<div>Tujuan			: <b><?php echo escape($rowBook->venue_destination_name. " - ".$rowBook->venue_destination_location." (".$rowBook->code_venue_destination.")") ?></b></div>
										<div>Waktu Keberangkatan : <b><?php echo escape($rowBook->departure_time); ?></b></div>
										<div>Waktu Tiba : <b><?php echo escape($rowBook->arrive_time); ?></b></div>

										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Harga dan Tipe Penerbangan</h5>
										<div>Harga dasar : <b><?php echo escape($rowBook->default_price); ?></b></div>
										<div>Tipe penerbangan : <b><?php echo escape($rowBook->show_type); ?></b></div>

										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Tiket</h5>
										<?php
										$selectTicketNum = $mysqli->query("SELECT * FROM view_ticket WHERE id_booking = '$rowBook->id_booking'");
										?>
										<div>Total tiket yang dipesan : <b><?php echo escape($selectTicketNum->num_rows); $selectTicketNum->free(); ?></b></div>
										<ul class="collection">
											<?php
											if($selectTicket = $mysqli->query("SELECT * FROM view_ticket WHERE id_booking = '$rowBook->id_booking';") or die($mysqli->error))
											{
												if($selectTicket->num_rows)
												{
													while($rowTicket = $selectTicket->fetch_object())
													{
														?>
														<li class="collection-item">
															<b><?php echo escape($rowTicket->ticket_name); ?></b>
															<br>
															<?php echo "No. bangku : ".escape($rowTicket->no_seat); ?>
															<div class="secondary-content">
																<?php echo "ID Tiket #".escape($rowTicket->id); ?>
															</div>
														</li>
														<?php
													}
													$selectTicket->free();
												}
											}
											?>
											
										</ul>

										<div class="section">
											<div class="divider"></div>
										</div>

										<h5>Pembayaran</h5>
										<div></div>
									</div>
									<div class="modal-footer">
										<a href="#!" class="modal-action modal-close waves-effect waves-yellow btn-flat ">Tutup</a>
									</div>
								</div>

								<tr data-target="<?php echo escape($rowBook->id_booking); ?>" class="modal-trigger">
									<td><?php echo escape($rowBook->id_booking); ?></td>
									<td><?php echo escape($rowBook->firstname," ",$rowBook->lastname); ?></td>
									<td><?php echo escape($rowBook->id_show); ?></td>
									<td><?php echo escape($rowBook->code_venue_departure." - ".$rowBook->code_venue_destination); ?></td>
									<td><?php echo escape($rowBook->id_plane); ?></td>
									<td><?php echo escape($rowBook->departure_time); ?></td>
									<td><i class="material-icons">visibility</i></td>
								</tr>
								<?php
							}
						$selectBook->free();
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