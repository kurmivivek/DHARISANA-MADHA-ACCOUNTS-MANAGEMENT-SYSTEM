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
						<h2>Error!</h2>
						<h3>Invalid date detected</h3>
					</div>
					<div class="panel-body">
							<strong>According to the system the date is <?php echo date('d-m-Y');?>.</strong>
							<p>Please adjust the date to the current value by following steps as below:</p>		
							<img src="img/change_date.png">
					</div>
					 <div class="panel-footer">
                    <div class="row">
						<div class="col-sm-12 col-md-12 ui-group-buttons">
							<a href="home.php" class="btn btn-lg btn-success" role="button" style="width:100%"><span class="glyphicon glyphicon-log-in" style="margin-right:10px;"></span> Go to CMS</a>
						</div>
                        </form>
                    </div>
                </div>
				</div>
	</div>
</div>
</body>
</html>
