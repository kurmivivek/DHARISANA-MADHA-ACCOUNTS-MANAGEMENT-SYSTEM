<?php 
require '../functions.php';
$out['msg']="No data received";
$out['success']=false;
if(isset(  $_POST['date'] ))
{
	extract($_POST);
	$date_unformated=$date;
	$date=dateFormat($date);
	$name=SQLite3::escapeString($name);
	$ledger=SQLite3::escapeString($ledger);
	if(isset($receipt))
		$receipt=SQLite3::escapeString($receipt);
	else
		$receipt='';
	if(isset($bill))
		$bill=SQLite3::escapeString($bill);
	else
		$bill='';
	$db = new SQLite3('../../db/core.db') or die('Unable to open database');
	$tran=$db->querySingle("BEGIN") or('error in begin');
	$res=$db->query("UPDATE record SET date='$date',name='$name',receipt_no='$receipt',bill_no='$bill',ledger_page_no='$ledger',amount='$amount' where id='$id'") or die('Query failed');
	if(!$res)
	{
		$tran=$db->querySingle("ROLLBACK");
		$out['msg']="Error: Could not complete the request.Please try again.";
	}	
	else
	{
		$tran=$db->querySingle("COMMIT");
		$out['success']=true;
		$out['msg']="Successfully edited the record";
	}
}
header('Content-Type: application/json');
echo json_encode($out);
?>