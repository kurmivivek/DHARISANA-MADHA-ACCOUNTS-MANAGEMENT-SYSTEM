<?php
$allowedExts = array("db");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if (in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    header("Location:database_backup.php?flag=-1");
	}
	else {
		  move_uploaded_file($_FILES["file"]["tmp_name"],
		  "../db/core.db");
		  chmod("../db/core.db", 0755);
		  header("Location:database_backup.php?flag=1");
	}
} else {
  header("Location:database_backup.php?flag=2");
}
?> 
