<?php
require 'db/connect.php';
require 'session.php';
require 'functions/security.php';
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
			<div class="row">
				<select class="col s6" id="idBooking" name="idBooking">
					<option value="" disabled selected>Pilih pemesanan</option>
					<?php
					if($selectBooking = $mysqli->query("SELECT id from booking WHERE username='$username_session'") or die($mysqli->error))
					{
						while($rowBooking = $selectBooking->fetch_object())
						{
							?>
								<option value="<?php echo escape($rowBooking->id); ?>"><?php echo escape($rowBooking->id) ?></option>
							<?
						}
					}
					?>
				</select>
				<label for="idBooking">ID Pemesanan</label>
			</div>
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
			$('select').material_select();
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