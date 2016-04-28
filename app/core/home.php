<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-sm-12 col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Home Screen</h3>
				</div>
				<div class="panel-body">
						Welcome to the DHARISANA MADHA WELFARE ASSOCIATION'S Accounts Managment System!
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
