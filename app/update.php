<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DHARISANA MADHA WELFARE ASSOCIATION CMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
    <link rel="stylesheet" href="css/chosen.css">
    <link type="text/css" href="css/style.css" rel="stylesheet">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chosen.jquery.min.js"></script>
</head>
<body>
<div class="container">
	<div class="col-sm-9 col-md-9 ">
				<div class="panel panel-danger top-padding" style="margin-top:30px">
					<div class="panel-heading">
						<h3>System Update</h3>
					</div>
					<div class="panel-body">
							<strong>The cms is being updated.Please dont close the window!</strong>
							<p>You will be redirected to the login once update is completed</p>		
							<img src="img/update.gif">
					</div>
					<?php
					 $db = new SQLite3('../db/core.db') or die('Unable to open database');
					 $result = $db->query('ALTER TABLE "cms_payment" ADD "interest" INTEGER DEFAULT 0') or die('Query failed');
					 $result = $db->query('SELECT * FROM cms_loan') or die('Query failed');
					 while ($row= $result->fetchArray())
					 {
							if(!is_numeric($row['balance']))
							$temp=$db->query('update cms_loan SET balance='.$row['loan_sanctioned'].' where loan_no='.$row['loan_no'].'');
					}	
					 header("Location:login.php");
					 unlink(__FILE__);
					?>
                </div>
				</div>
	</div>
</div>
</body>
</html>
