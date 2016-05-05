<?php 
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
	}
}
if(isset($_GET['url']) && $_GET['url']!='')
	header("location:".$_GET['url']);
else
	header("Location:../home.php");
?>