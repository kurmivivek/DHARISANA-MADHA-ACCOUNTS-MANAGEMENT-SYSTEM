<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
<?php include 'password.php';?>
        <div class="col-sm-12 col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Add New Admin</h3>
				</div>
				<div class="panel-body">
					<?php 
					if(isset($_POST['submit'] ))
					{	
						extract($_POST);
						if($newpass==$confirmpass)
						{
							$db = new SQLite3('../db/core.db') or die('Unable to open database');
							$checkUser=$db->querySingle("select count(*) from cms_admin where admin_name='".$username."'") or ($checkUser=0);
							if($checkUser==0)
							{
							$passHash = password_hash($newpass, PASSWORD_DEFAULT);
							$query="INSERT INTO cms_admin (admin_name,admin_pass,admin_fname,admin_lname,admin_email,admin_phone) VALUES ('$username','$passHash','$firstname','$lastname','$email','$phone')";
							$db->exec($query) or die("Unable to add into database");
							echo '<div class="alert alert-success fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Admin added sucessfully.
							</div>';
							}
							else
							{
							echo '<div class="alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Error: Username already exists.Please try again.
							</div>';
							}
							
						}
						else
						{
							echo '<div class="alert alert-danger fade in">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							Error: New password does not match Confirm password.Please try again.
							</div>';
						}
					}
					?>
					<form class="form-horizontal col-md-9" role="form" method="post">
							  <div class="form-group">
								<label for="name" class="col-sm-2 control-label">Name</label>
								  <div class="col-sm-5 col-md-5">
									<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
								  </div>
								  <div class="col-sm-5 col-md-5">
									<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
								  </div>
							  </div>					  
							  <div class="form-group">
								<label for="inputEmail" class="col-sm-2 control-label"> Email</label>
								  <div class="col-sm-10">
								  <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputPhone" class="col-sm-2 control-label"> Contact</label>
								<div class="col-sm-10">
								  <input type="number" class="form-control" name="phone" id="inputPhone" placeholder="Contact No.">
								</div>
							  </div>
							  <div class="form-group">
								<label for="username" class="col-sm-2 control-label">Username</label>
								  <div class="col-sm-10">
								  <input type="text" class="form-control" name="username" id="oldpass" placeholder="Username">
								</div>
							  </div>
							  <div class="form-group">
								<label for="newpass" class="col-sm-2 control-label"> New password</label>
								  <div class="col-sm-10">
								  <input type="password" class="form-control" name="newpass" id="newpass" placeholder="New password">
								</div>
							  </div>
							  <div class="form-group">
								<label for="confirmpass" class="col-sm-2 control-label">Confirm Password</label>
								<div class="col-sm-10">
								  <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Re-enter password">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create</button>
								</div>
							  </div>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
