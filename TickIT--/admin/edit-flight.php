<?php
require '../db/connect.php';
require 'session.php';
require '../functions/security.php';
require '../functions/formatingid.php';


if(isset($_GET['idShow']))
{
	$idShow = trim($_GET['idShow']);

	if($selectShow = $mysqli->query("SELECT * FROM `show` WHERE id='$idShow'") or die($mysqli->error))
	{
		$rowShow = $selectShow->fetch_object();
		$departure_date = substr($rowShow->departure_time, 0,10);
		$departure_time = substr($rowShow->departure_time, 11,5);

		$arrival_date = substr($rowShow->arrive_time, 0,10);
		$arrival_time = substr($rowShow->arrive_time, 11,5);
	}

	if(isset($_POST['update']))
	{
		$plane_code = $_POST['plane_code'];
		$departure_code = $_POST['departure_code'];
		$departure_date = $_POST['departure_date'];
		$departure_time	= $_POST['departure_time'].":00";
		$departure_datetime = date("Y-m-d", strtotime($departure_date))." ".$departure_time;

		$destination_code	= $_POST['destination_code'];
		$arrival_date		= $_POST['arrival_date'];
		$arrival_time		= $_POST['arrival_time'].":00";
		$arrival_datetime = date("Y-m-d", strtotime($arrival_date))." ".$arrival_time;

		$price = $_POST['price'];
		$show_type = $_POST['show_type'];

		if($updateShow = $mysqli->query("UPDATE `show` SET id_plane='$plane_code', id_type='$show_type', code_venue_departure='$departure_code', code_venue_destination='$destination_code', departure_time='$departure_datetime', arrive_time='$arrival_datetime', default_price='$price' WHERE id='$idShow'") or die($mysqli->error))
		{
			if($rowShow->id_plane != $plane_code)
			{
				if($deleteSeat = $mysqli->query("DELETE FROM seat WHERE id_show='$rowShow->id'"))
				{
					if($selectPlane = $mysqli->query("SELECT seat FROM plane WHERE id = '$plane_code'"))
					{
						$rowPlane = $selectPlane->fetch_object();
						$seatTotal = $rowPlane->seat;

						for($i=1;$i<=$seatTotal;$i++)
						{
							$insertSeat = $mysqli->query("INSERT INTO seat(id_show,no,name,status) VALUES('$rowShow->id','$i','HAI','0')");
						}
						$selectPlane->free();
						header("Location:flight-schedule.php");	
					}
					else
					{
						echo "hai2";
					}
				}
			}
			else
			{
				header("Location:flight-schedule.php");
			}
		}
		else
		{
			echo "hai";
		}

	}
}
else
{
	header("Location:flight-schedule.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel TickIT - Sunting Penerbangan</title>
	<link href="../css/google-material-font.css" rel="stylesheet">
	<link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../css/lolliclock.css" type="text/css" rel="stylesheet" media="screen,projection"/>
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
			<h3 class="brown-text darken-1">Edit Penerbangan #<?php echo escape($rowShow->id); ?></h3>
			<div class="section">
				<form action="" method="post">
					<div class="row">
						<div class="input-field col s6">
							<select id="plane" name="plane_code">
								<option value="" disabled selected>Pilih pesawat</option>
								<?php
									if($selectPlane = $mysqli->query("SELECT * FROM view_plane"))
									{
										while($rowPlane = $selectPlane->fetch_object())
										{
											if($rowPlane->id === $rowShow->id_plane)
											{
												?>
													<option selected="selected" value="<?php echo escape($rowPlane->id); ?>"><?php echo escape($rowPlane->name) ?></option>
												<?
											}
											else
											{
												?>
													<option value="<?php echo escape($rowPlane->id); ?>"><?php echo escape($rowPlane->name) ?></option>
												<?php
											}
										}
										$selectPlane->free();
									}
								?>
							</select>
							<label>Pilih Pesawat</label>
						</div>
						<div class="section col s6" id="seat">
						</div>
					</div>
					<p class="red-text">Menyunting pesawat, berarti mengahapus semua pemesanan sebelumnya! Harap teliti!</p>
					<div class="divider"></div>
					<div class="section">
						<h5>Keberangkatan</h5>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<select name="departure_code">
								<option value="" disabled selected>Pilih Lokasi</option>
								<?php
									if($selectVenue = $mysqli->query("SELECT * FROM view_venue"))
									{
										while($rowVenue = $selectVenue->fetch_object())
										{
											if($rowVenue->code === $rowShow->code_venue_departure)
											{
												?>
													<option selected="selected" value="<?php echo escape($rowVenue->code); ?>"><?php echo escape($rowVenue->name) ?></option>
												<?
											}
											else
											{
												?>
													<option value="<?php echo escape($rowVenue->code); ?>"><?php echo escape($rowVenue->name) ?></option>
												<?php
											}
										}
										$selectVenue->free();
									}
								?>
							</select>
							<label>Lokasi</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input name="departure_date" id="departure_date" type="date" class="datepicker" value="<?php echo escape($departure_date); ?>">
							<label for="departure_date">Tanggal</label>
						</div>
						<div class="input-field col s6">
							<input name="departure_time" type="time" id="pick-a-time" value="<?php echo escape($departure_time); ?>">
						</div>
					</div>
					<div class="divider"></div>
					<div class="section">
						<h5>Tujuan</h5>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<select name="destination_code">
								<option value="" disabled selected>Pilih Lokasi</option>
								<?php
									if($selectVenue = $mysqli->query("SELECT * FROM view_venue"))
									{
										while($rowVenue = $selectVenue->fetch_object())
										{
											if($rowVenue->code === $rowShow->code_venue_destination)
											{
												?>
													<option selected="selected" value="<?php echo escape($rowVenue->code); ?>"><?php echo escape($rowVenue->name) ?></option>
												<?
											}
											else
											{
												?>
													<option value="<?php echo escape($rowVenue->code); ?>"><?php echo escape($rowVenue->name) ?></option>
												<?php
											}
										}
										$selectVenue->free();
									}
								?>
							</select>
							<label>Lokasi</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input name="arrival_date" id="date" type="date" class="datepicker" value="<?php echo escape($arrival_date); ?>">
							<label for="date">Tanggal</label>
						</div>
						<div class="input-field col s6">
							<input name="arrival_time" type="time" id="pick-a-time2" value="<?php echo escape($arrival_time); ?>">
						</div>
					</div>
					<div class="section">
						<h5>Harga dan Tipe penerbangan</h5>
						<p>Harga akhir adalah setelah dijumlahkan dengan harga tipe penerbangan.</p>
						<div class="row">
							<div class="input-field col s12 l6">
								<input name="price" id="price" type="text" required value="<?php echo escape($rowShow->default_price) ?>">
								<label for="price">Harga dasar</label>
							</div>
							<div class="input-field col s12 l6">
								<select name="show_type" id="show_type">
									<option value="" disabled selected>Piih Tipe Penerbangan</option>
									<?php
										if($selectShowType = $mysqli->query("SELECT * FROM view_show_type"))
										{
											while($rowShowType = $selectShowType->fetch_object())
											{
												if($rowShowType->id === $rowShow->id_type)
												{
													?>
														<option selected="selected" value="<?php echo escape($rowShowType->id); ?>"><?php echo escape($rowShowType->type) ?></option>
													<?
												}
												else
												{
													?>
														<option value="<?php echo escape($rowShowType->id); ?>"><?php echo escape($rowShowType->type) ?></option>
													<?php
												}
											}
										}
									?>
								</select>
								<label>Tipe Penerbangan</label>
							</div>
							<div id="totalPrice"></div>
						</div>
					</div>
					<button type="submit" class="btn waves-effect brown lighten-1" name="update">Simpan</button>
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		
	</div>
	<!--  Scripts-->
  	<script src="../js/jquery-2.1.1.min.js"></script>
  	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>
	<script src="../js/lolliclock.js"></script>
	<script src="../js/disable-date.js"></script>
	<script type="text/javascript" src="js/admin.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
			$('.datepicker').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15 // Creates a dropdown of 15 years to control year
			});
		});
	</script>
	<script type="text/javascript">
		$('#pick-a-time').lolliclock({autoclose:false});
		$('#pick-a-time2').lolliclock({autoclose:false});
	</script>
</body>
</html>