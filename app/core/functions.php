<?php
function dateFormat($date)
{
	$temp=explode( '-', $date);
	$corrected_date=$temp[2]."-".$temp[1]."-".$temp[0];
	return $corrected_date;
}
function check_date()
{
	$today = new DateTime('now');
	$reference = new DateTime('2014-08-01');

	if ($today<$reference) { header("Location:set_correct_date.php"); }
}
?>
