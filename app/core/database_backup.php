<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-sm-12 col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Database Backup/Restore</h3>
				</div>
				<div class="panel-body">
				<?php 
				if(isset($_GET['flag']))
				{
					if($_GET['flag']==1)
					{echo '<div class="alert alert-success fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									Database successfully restored.
								</div>';
					}
					else if($_GET['flag']==2)
					{echo '<div class="alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									Invalid file!! Restore Unsuccessful.
								</div>';
					}
					else
					{echo '<div class="alert alert-danger fade in">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									Error Encountered.Restore Unsuccessful.
								</div>';
					}
				}
				 ?>
					<div class="col-sm-8 col-md-4">
							<label class="col-sm-4 control-label"> Create Backup:</label><a role="button" class="btn btn-lg btn-success" href="download.php?filename=core.db"><span class="glyphicon glyphicon-download"></span> BackUp</a>
					</div>
					<form class="form-horizontal col-md-9" role="form" action="upload_file.php" method="post" enctype="multipart/form-data">
								  <div class="form-group">
									<label for="file" class="col-sm-2 control-label"> Restore Backup:</label>
									  <div class="col-sm-5">
										<input type="file" name="file" id="file" style="margin-top: 15px;"><br>
									 </div>
							 <button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-upload"></span>  Restore</button>
						  </div>
						</form>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
