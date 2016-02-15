<?php
require 'db/connect.php';
require 'session.php';
require 'functions/security.php';
require 'functions/formatingid.php';


if(isset($_POST['book']) && isset($_POST['idSeat']))
{
	$idShow = $_POST['idShow'];
}
else
{
	header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Mengudara - Membawa Indonesia ke seluruh dunia</title>
	<link href="css/google-material-font.css" rel="stylesheet">
	<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<div class="header">
		<?php
		require 'includes/nav.php';
		?>
	</div>
	<div class="main">
		<div class="container">
			<?php
			if($selectShow = $mysqli->query("SELECT * FROM view_show WHERE show_id='$idShow'") OR die($mysqli->error))
			{
				$rowShow = $selectShow->fetch_object();
				?>
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
				<form action="book-proccess.php" method="post">
					
					<div class="row section">
						<div class="input-field">
							<input type="text" name="idShow" value="<?php echo $idShow; ?>" hidden="hidden">
						</div>
						<?php
						$i = 0;
						foreach($_POST['idSeat'] as $key=>$idSeat) 
						{
							$selectSeat = $mysqli->query("SELECT no FROM seat WHERE id='$idSeat'");
							$rowSeat = $selectSeat->fetch_object();
							?>
								<div class="row">
									<div class="input-field col s6">
										<input id="idSeat-<?php echo escape($idSeat); ?>" type="text" name="idSeat[]" readonly="readonly" value="<?php echo $idSeat?>">
										<label for="idSeat-<?php echo escape($idSeat); ?>">ID Bangku</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input id="noSeat-<?php echo escape($idSeat); ?>" type="text" name="noSeat" readonly="readonly" value="<?php echo escape($rowSeat->no); ?>">
										<label for="noSeat-<?php echo escape($idSeat); ?>">No. Bangku</label>
									</div>
									<div class="input-field col s6">
										<input id="ticketFor-<?php echo escape($idSeat); ?>" type="text" name="ticketFor[]" required="required">
										<label for="ticketFor-<?php echo escape($idSeat); ?>">Atas nama</label>
									</div>
								</div>
								<div class="section">
									<div class="divider"></div>
								</div>
							<?php
							$i++;
						}
						?>
					</div>
					<div>
						<h5>Total harga: Rp. <?php echo escape(($i)*($rowShow->default_price+$rowShow->show_type_price)); ?></h5>
						<div class="input-field">
							<input type="text" name="totalPrice" value="<?php echo escape(($i)*($rowShow->default_price+$rowShow->show_type_price)); ?>" hidden="hidden">
						</div>
					</div>
					<div class="row">
						<button name="book-ticket" class="btn waves-effect">Pesan bangku</button>
					</div>
				</form>
				<?php
			}
			?>
		</div>
	</div>

	<footer class="page-footer blue lighten-1">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Mengudara Airlines</h5>
					<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				2014 Copyright Text
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
			</div>
		</div>
    </footer>
	<!--  Scripts-->
  	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/disable-date.js"></script>
  	<script src="js/materialize.js"></script>
  	<script src="js/main.js"></script>
	<script src="js/init.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.modal-trigger').leanModal();
			$('select').material_select();
			$('.datepicker').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15 // Creates a dropdown of 15 years to control year
			});
		});

	</script>
</body>
</html>