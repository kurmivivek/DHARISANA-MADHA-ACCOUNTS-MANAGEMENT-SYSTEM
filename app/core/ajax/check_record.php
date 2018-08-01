<?php 
require '../functions.php';
if(isset(  $_GET['category'] ))
{
	extract($_GET);
	if(isset($receipt))
		$receipt=SQLite3::escapeString($receipt);
	else
		$receipt='';
	$operator_name=$_COOKIE['admin_name'];
	$db = new SQLite3('../../db/core.db') or die('Unable to open database');
	$row=$db->querySingle("SELECT count(*) as count FROM record WHERE category='$category' AND type='$type' AND receipt_no='$receipt' AND strftime('%Y-%m',date)=strftime('%Y-%m','now','localtime')") or ($row=0);
    if ($row == 0) 
    { 
		$out['valid']=true;
	}	
	else
	{
		$out['valid']=false;
	}
}
header('Content-Type: application/json');
echo json_encode($out);
?>