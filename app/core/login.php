<?php
	$message=-1;
	if(isset($_GET['logout'])) {
	if (isset($_COOKIE['admin_id'])) setcookie("admin_id",$_COOKIE['admin_id'],time()-3600);
	if (isset($_COOKIE['admin_name'])) setcookie("admin_name",$_COOKIE['admin_name'],time()-3600);
	if (isset($_COOKIE['admin_fname']))setcookie("admin_fname",$_COOKIE['admin_fname'],time()-3600);
	$message=2;
	}
	elseif(isset($_COOKIE['admin_id']))
	{
			header("Location:home.php");
	}
	else{};
	$update=file_exists('update.php');
	if($update)
	{
		header("Location:update.php");
	}
?>
<?php include 'head.php'; 
include 'password.php';?>
<body id="index">
	<?php
	$db = new SQLite3('../db/core.db') or die('Unable to open database');
	if(isset(  $_POST['submit'] ))
	{	
			$res=$db->query("Select * from cms_admin
			where admin_name='".$_POST['username']."'
			") or die('Query failed');
			
			if(!$res)
			{
				$message=0;
			}
			else
			{
				$row=$res->fetchArray();
				if(password_verify($_POST['password'],$row['admin_pass']))
				{
					setcookie("admin_id",$row['admin_id']);
					setcookie("admin_name",$row['admin_name']);
					setcookie("admin_fname",$row['admin_fname']);
					header("Location:home.php");
				}
				else
					$message=0;
			}			
	}
	?>
    <div class="container">
    <div class="row" id="login-panel">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 ">
        <?php
			if($message==0)
			{
			echo '<div class="alert alert-danger"> Incorrect username or password!</div>';
			}
			if($message==1)
			{
			echo '<div class="alert alert-success fade in"> Already logged in!</div>';
			}
			if($message==2)
			{
			echo '<div class="alert alert-success fade in"> Successfully Signed out!</div>';
			}
			
        ?>
        <!-- login panel starts-->
            <div class="panel panel-primary">
                 <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock" style="font-size:18px"></span><strong style="font-size:20px"> Login</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 login-box">
                            <form role="form" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" name="password" placeholder="Password" required />
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
						<div class="col-sm-12 col-md-12 ui-group-buttons">
							<button type="submit" name="submit" class="btn btn-lg btn-success" role="button" style="width:100%"><span class="glyphicon glyphicon-log-in" style="margin-right:10px;"></span> Sign in</button>
						</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login panel ends-->
    </div>
	</div>
	<div style="text-align:center;position:fixed;bottom:0;margin:0 auto;left: 0;right: 0;font-size: 20px;padding-bottom: 15px;color:#fff">
       	<span class="glyphicon glyphicon-fire" style="color:#ec971f"></span><strong>Kode</strong>Ignite
    </div>
</body>
</html>
