<?php
require '../../db/connect.php';
require '../../functions/security.php';


//Get Seat From Plane
if(isset($_GET['idPlane']))
{
	$idPlane = $_GET['idPlane'];
	if($selectPlane = $mysqli->query("SELECT seat FROM plane WHERE id='$idPlane'"))
	{
		$rowPlane = $selectPlane->fetch_object();
		?>
			<div class="section col s6">
				Jumlah kursi: <b><?php echo escape($rowPlane->seat); ?></b>
			</div>
		<?php
	}
}

if(isset($_GET['prices']) && isset($_GET['showType']))
{
	$showType = $_GET['showType'];
	(int)$prices = $_GET['prices'];
	if($selectShowType = $mysqli->query("SELECT price+{$prices} AS totalPrice FROM show_type WHERE id='$showType'"))
	{
		$rowShowType = $selectShowType->fetch_object();
		?>
			<div class="section col s6">
				Total Harga: <b><?php echo escape($rowShowType->totalPrice); ?></b>
			</div>
		<?php
	}
	
}


?>