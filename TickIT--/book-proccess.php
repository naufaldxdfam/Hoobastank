<?php
require 'db/connect.php';
require 'session.php';
require 'functions/security.php';
require 'functions/formatingid.php';

if(isset($_POST['book-ticket']))
{
	$idShow = $_POST['idShow'];
	$id = format('booking');
	$totalPrice = $_POST['totalPrice'];
	if($insertBook = $mysqli->query("INSERT INTO booking(id,id_show,username,time,totalPrice) VALUES('$id','$idShow','$username_session',NOW(),'$totalPrice')") or die($mysqli->error))
	{
		$i = 0;
		foreach($_POST['ticketFor'] as $key=>$ticketFor) 
		{
			$idSeat = $_POST['idSeat'];
			if($insertTicket = $mysqli->query("INSERT INTO ticket(id,id_booking,name) VALUES('$idSeat[$i]','$id','$ticketFor')") or die($mysqli->error))
			{
				if($updateSeat = $mysqli->query("UPDATE seat SET status='1' WHERE id='$idSeat[$i]'"))
				{
					header("Location:yeay.php");
				}
			}
			$i++;
		}
	}
}
?>