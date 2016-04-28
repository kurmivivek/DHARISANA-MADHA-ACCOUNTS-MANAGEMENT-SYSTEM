<?php
	include 'password.php';
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
	$success="";
	if(isset(  $_GET['update'] ))
	{
		$db = new SQLite3('../db/core.db') or die('Unable to open database');
		$res=$db->query("UPDATE cms_admin SET admin_fname='".$_GET['firstname']."',admin_lname='".$_GET['lastname']."',admin_email='".$_GET['email']."',admin_phone='".$_GET['phone']."' WHERE admin_id='".$_COOKIE['admin_id']."'
			") or die('Query failed');
		$_COOKIE['admin_fname']=$_GET['firstname'];
		$s=1;$success="Changes succesfully saved.";
	}
	if(isset( $_POST['update_pass'] ))
	{
		$db = new SQLite3('../db/core.db') or die('Unable to open database');
		$res=$db->query("Select * from cms_admin where admin_id='".$_COOKIE['admin_id']."'") or die('Query failed');
		$row=$res->fetchArray();
		if(password_verify($_POST['password'],$row['admin_pass']) && $_POST['newpass']==$_POST['confirmpass'])
		{
			$passHash = password_hash($_POST['newpass'], PASSWORD_DEFAULT);
			$res=$db->query("UPDATE cms_admin SET admin_pass='".$passHash."' WHERE admin_id='".$_COOKIE['admin_id']."'
			") or die('Query failed');
			$s=1;$success="Password successfully changed.";
		}
		else
		{
			$s=2;$success="Unable to change the Password.Please check if the old password is correct and the new password matches the confirm password.";
		}
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-sm-12 col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Account setting</h3>
				</div>
				<div class="panel-body">
					<ul id="myTab" class="nav nav-pills">
					  <li class="active"><a href="#account" data-toggle="tab">Account info</a></li>
					  <li><a href="#password" data-toggle="tab">Change Password</a></li>
					</ul>
					<?php if($success!="") { echo '<div class="alert ';
					if($s==1) echo 'alert-success '; else echo 'alert-danger ';
					echo 'fade in" style="margin-top:10px">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					'.$success.'</div>';}?>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="account">
							<?php
							$db = new SQLite3('../db/core.db') or die('Unable to open database');
							$res=$db->query("Select * from cms_admin
											where admin_id='".$_COOKIE['admin_id']."'
											") or die('Query failed');
							$row=$res->fetchArray();
							echo '<form class="form-horizontal col-md-9" role="form">
							  <div class="form-group">
								<label for="name" class="col-sm-2 control-label">Name</label>
								  <div class="col-sm-5 col-md-5">
									<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="'.$row['admin_fname'].'">
								  </div>
								  <div class="col-sm-5 col-md-5">
									<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname" value="'.$row['admin_lname'].'">
								  </div>
							  </div>					  
							  <div class="form-group">
								<label for="inputEmail" class="col-sm-2 control-label"> Email</label>
								  <div class="col-sm-10">
								  <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" value="'.$row['admin_email'].'">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputPhone" class="col-sm-2 control-label"> Contact</label>
								<div class="col-sm-10">
								  <input type="number" class="form-control" name="phone" id="inputPhone" placeholder="Contact No." value="'.$row['admin_phone'].'">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" name="update" class="btn btn-default">Save</button>
								</div>
							  </div>
							</form>';?>
						</div>
						<div class="tab-pane fade in" id="password">
							<form class="form-horizontal col-md-9" role="form" method="post">				  
							  <div class="form-group">
								<label for="oldpass" class="col-sm-2 control-label">Old password</label>
								  <div class="col-sm-10">
								  <input type="password" class="form-control" name="password" id="oldpass" placeholder="Old password">
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
								  <button type="submit" name="update_pass" class="btn btn-default">Change</button>
								</div>
							  </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
