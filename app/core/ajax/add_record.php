<?php 
require '../functions.php';
$out['msg']="No data received";
$out['success']=false;
if(isset(  $_POST['category'] ))
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
	$operator_name=$_COOKIE['admin_name'];
	$db = new SQLite3('../../db/core.db') or die('Unable to open database');
	$tran=$db->querySingle("BEGIN") or('error in begin');
	$res=$db->query("Insert INTO record ('category','type','date','name','receipt_no','bill_no','ledger_page_no','amount','operator_name','timestamp') VALUES ('$category','$type','$date','$name','$receipt','$bill','$ledger','$amount','$operator_name',strftime('%Y-%m-%d %H:%M:%S','now','localtime'))
	") or die('Query failed');
	if(!$res)
	{
		$tran=$db->querySingle("ROLLBACK");
		$out['msg']="Error: Could not complete the request.Please try again.";
	}	
	else
	{
		$tran=$db->querySingle("COMMIT");
		$out['success']=true;
		$out['date']=$date_unformated;
		$out['name']=$name;
		$out['receipt_no']=$receipt;
		$out['amount']=$amount;
		$out['ledger_page_no']=$ledger;
		$out['bill_no']=$bill;
		$out['msg']="Successfully added the record";
	}
}
header('Content-Type: application/json');
echo json_encode($out);
?>