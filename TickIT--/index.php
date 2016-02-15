<?php
require 'db/connect.php';
require 'session.php';
require 'functions/security.php';


if(isset($_POST['search']))
{
	$from 	= $_POST['from'];
	$to 	= $_POST['to'];
	if(!empty($_POST['date']))
	{
		$date 	= date("Y-m-d", strtotime($_POST['date']));
	}
	
	header("Location:schedule.php?from=$from&to=$to&date=$date");
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
		<div class="parallax-container">
			<div class="parallax"><img src="images/parallax1.jpg"></div>
		</div>

		<div class="container section yellow">
		</div>

		<div class="container section white">
			<h2>Mengudara</h2>
			<p>Membawa Indonesia ke Seluruh Dunia.</p>
		</div>
		<div class="white-text container section blue-grey darken-3">
			<div class="container">
				<form action="" method="post">
					<div class="row">
						<h2 class="col s12 l7">Bawa saya dari</h2>
						<div class="input-field col s12 l4">
							<select name="from">
								<option value="" disabled selected></option>
								<?php
									$selectVenue = $mysqli->query("SELECT * FROM venue");
									while($rowVenue = $selectVenue->fetch_object())
									{
									?>
										<option value="<?php echo $rowVenue->code ?>"><?php echo $rowVenue->name ?></option>
										<?php
									}
									?>
							</select>
						</div>
					</div>
					<div class="row">
						<h2 class="col s12 l2">ke</h2>
						<div class="input-field col s12 l4">
							<select name="to">
								<option value="" disabled selected></option>
								<?php
									$selectVenue = $mysqli->query("SELECT * FROM venue");
									while($rowVenue = $selectVenue->fetch_object())
									{
									?>
										<option value="<?php echo $rowVenue->code ?>"><?php echo $rowVenue->name ?></option>
										<?php
									}
									?>
							</select>						</div>
						<h2 class="col s12 l6">pada</h2>
	  				</div>
	  				<div class="row">
	  					<h2 class="col s12 l4">tanggal</h2>
	  					<div class="col s12 l6">
	  						<input name="date" type="date" class="datepicker">
	  					</div>
	  				</div>
	  				<div class="row">
	  					<button name="search" class="btn-find btn waves-effect">yuk!</button>
	  				</div>
	  			</form>
			</div>
		</div>
		<br><br> 	

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
	<script src="js/init.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
			$('.datepicker').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15 // Creates a dropdown of 15 years to control year
			});
		});

	</script>
</body>
</html>