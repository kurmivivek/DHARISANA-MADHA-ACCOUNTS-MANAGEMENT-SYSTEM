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
					<h3>Delete Admin</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
					<?php
					if(isset($_GET['admin_id']))
					{
						if($_GET['admin_id']!=$_COOKIE['admin_id'])
						{$db = new SQLite3('../db/core.db') or die('Unable to open database');
						$res=$db->query("delete from cms_admin where admin_id='".$_GET['admin_id']."'") or die('Query failed');
						echo '<div class="alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								User deleted sucessfully.
								</div>';}
						else
						{
							echo '<div class="alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								Cant delete as user is logged in.
								</div>';
						}
					}
					?>
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Admin name</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$db = new SQLite3('../db/core.db') or die('Unable to open database');
					$result = $db->query("SELECT * FROM cms_admin") or die('Query failed');
					while ($row = $result->fetchArray())
					{
					echo "<tr><td>{$row['admin_name']}</td><td>{$row['admin_fname']}</td><td>{$row['admin_lname']}</td><td>{$row['admin_email']}</td><td>{$row['admin_phone']}</td><td><a href='admin_delete.php?c=5&admin_id={$row['admin_id']}' class='btn btn-danger' role='button'></span>Delete Admin</a></td></tr>";
					}
					?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
