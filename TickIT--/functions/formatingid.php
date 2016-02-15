<?php
// require '../db/connect.php';
// require 'security.php';

function format($table)
{
	global $mysqli;

	$selectFormat 	= $mysqli->query("SELECT code,LENGTH(code) AS codeLength FROM `format` WHERE `table`='$table'");
	$rowFormat 		= $selectFormat->fetch_object();
	$codeLength		= $rowFormat->codeLength;

	$select = $mysqli->query("SELECT MAX(CAST(SUBSTRING(id, $codeLength+2, LENGTH(id)-$codeLength) AS UNSIGNED)) AS jumlah FROM `$table`;");
	$row	= $select->fetch_object();
	$maxId 	= $row->jumlah;

	if(empty($maxId))
	{
		$maxId = "0001";
	}
	else
	{
		$maxId++;
		$maxId 	= str_pad($maxId, 4, 0, STR_PAD_LEFT);
	}
	
	$maxId = $rowFormat->code ."-". $maxId;
	return $maxId; 
}

?>