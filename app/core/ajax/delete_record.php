<?php
$dSuccess=0; 
if(isset(  $_GET['id'] ))
{
	extract($_POST);
	$id=$_GET['id'];
	$db = new SQLite3('../../db/core.db') or die('Unable to open database');
	$tran=$db->querySingle("BEGIN") or('error in begin');
	$res=$db->query("DELETE from record where id='$id'") or die('Query failed');
	if(!$res)
	{
		$tran=$db->querySingle("ROLLBACK");
	}	
	else
	{
		$tran=$db->querySingle("COMMIT");
		$dSuccess=1;
	}
	$db->close();
}
if(isset($_GET['url']) && $_GET['url']!='')
	header("location:".array_shift(explode("?", $_GET['url']))."?dSuccess=".$dSuccess);
else
	header("Location:../home.php?dSuccess=".$dSuccess);
?>