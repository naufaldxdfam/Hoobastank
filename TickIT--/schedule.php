<?php
require 'db/connect.php';
require 'session.php';
require 'functions/security.php';


$from 	= $_GET['from'];
$to 	= $_GET['to'];
if(!empty($_GET['date']))
{
	$date 	= date("Y-m-d", strtotime($_GET['date']));
}

if(!empty($from) OR !empty($to) OR !empty($date))
{
	$query_where_selectShow = " WHERE";
	if(!empty($from))
	{
		$query_where_selectShow = $query_where_selectShow." code_venue_departure='$from' ";
		$query_where_and = " AND ";
	}
	if(!empty($to))
	{
		$query_where_selectShow = $query_where_selectShow." ".$query_where_and." code_venue_destination='$to' ";
		$query_where_and = " AND ";
	}
	if(!empty($date))
	{
		$query_where_selectShow = $query_where_selectShow." ".$query_where_and." departure_time LIKE '%$date%' ";
	}
	
}


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
	<title>Mengudara - Cari Penerbangan</title>
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
			<div class="section">
				<form action="" method="post">
					<div class="row">
						<div class="col s12 l4 input-field">
							<select id="from" name="from">
								<option value="" disabled selected>Pilih bandara</option>
								<?php
									if($selectVenue = $mysqli->query("SELECT * FROM view_venue"))
									{
										while($rowVenue = $selectVenue->fetch_object())
										{
											if($rowVenue->code === $from)
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
							<label for="from">Dari</label>
						</div>
						<div class="col s12 l4 input-field">
							<select id="to" name="to">
								<option value="" disabled selected>Pilih bandara</option>
								<?php
									if($selectVenue = $mysqli->query("SELECT * FROM view_venue"))
									{
										while($rowVenue = $selectVenue->fetch_object())
										{
											if($rowVenue->code === $to)
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
							<label for="to">Ke</label>
						</div>
						<div class="col s12 l4 input-field">
							<input id="date" name="date" type="date" class="datepicker" value="<?php echo escape($date); ?>">
							<label for="date">Tanggal</label>						
						</div>
					</div>
					<div class="row">
	  					<button name="search" class="right btn waves-effect">Cari!</button>
	  				</div>
  				</form>
			</div>
			<div class="section">
				<table class="highlight">
					<thead>
						<tr>
							<th>No.</th>
							<th>Keberangkatan</th>
							<th>Tujuan</th>
							<th>Kode Pesawat</th>
							<th>Waktu Kbrngktn</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($selectShow = $mysqli->query("SELECT * FROM view_show $query_where_selectShow") OR die($mysqli->error))
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
											<a href="book.php?idShow=<?php echo escape($rowShow->show_id); ?>" class="modal-action modal-close waves-effect waves-yellow btn-flat ">Pesan</a>
										</div>
									</div>

									<tr data-target="<?php echo escape($rowShow->show_id); ?>" class="modal-trigger">
										<td><?php echo escape($rowShow->show_id); ?></td>
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
		$(document).ready(function(){
			// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
			$('.modal-trigger').leanModal();
		});
	</script>
</body>
</html>