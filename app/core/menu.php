<body id="home">
<!-- Navigation bar starts-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<a class="navbar-brand" href="home.php" style="color:#fff;font-weight:600;"> DHARISANA MADHA WELFARE ASSOCIATION'S ACCOUNTS MANAGMENT SYSTEM</a>
        <ul class="nav navbar-nav">
           <li class="dropdown">
                <a href="#" role="button" aria-expanded="false"> Church<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="member_add_new.php"><span class="glyphicon glyphicon-plus"></span> Income</a></li>
                    <li><a href="member_view.php"><span class="glyphicon glyphicon-minus"></span> Expenditure</a></li>
                  </ul>
            </li>
            <li class="dropdown">
                <a href="#" role="button" aria-expanded="false"> School<span class="caret"></span>
                </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="member_add_new.php"><span class="glyphicon glyphicon-plus"></span> Income</a></li>
                    <li><a href="member_view.php"><span class="glyphicon glyphicon-minus"></span> Expenditure</a></li>
                  </ul>
            </li>
            <!--li class="dropdown">
                <a href="#" role="button" aria-expanded="false"> Subcription<span class="caret"></span>
                </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="subcription_add_new.php"><span class="glyphicon glyphicon-plus"></span> New Subcription</a></li>
                    <li><a href="subcription_view.php"><span class="glyphicon glyphicon-eye-open"></span> View Subcription</a></li>
                  </ul>
            </li-->
            <li class="dropdown">
                <a href="#" role="button" aria-expanded="false"> Bank<span class="caret"></span>
                </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="member_add_new.php"><span class="glyphicon glyphicon-plus"></span> Income</a></li>
                    <li><a href="member_view.php"><span class="glyphicon glyphicon-minus"></span> Expenditure</a></li>
                  </ul>
            </li>
        </ul>
          <div class="btn-group navbar-right" style="margin-right:50px">
			<button type="button" class="btn btn-success dropdown-toggle navbar-btn" data-toggle="dropdown"><?php echo $_COOKIE['admin_fname']; ?> <span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="admin_account_setting.php?c=5"><span class="glyphicon glyphicon-wrench"></span> Account Settings</a></li>
			  <li><a href="admin_add_admin.php?c=5"><span class="glyphicon glyphicon-plus"></span> Add new User</a></li>
              <li><a href="database_backup.php?c=5"><span class="glyphicon glyphicon glyphicon-download-alt"></span> Backup/Restore Database</a></li>
			  <li class="divider"></li>
			  <li><a href="login.php?logout"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
              <li class="divider"></li>
              <li style="text-align:center">v1.0.0β</li>
              <li style="text-align:center">Made with <span class="glyphicon glyphicon-heart" style="color:#c7254e"></span> at <br/><span class="glyphicon glyphicon-fire" style="color:#ec971f"></span><strong>Kode</strong>Ignite<li>
			</ul>
		  </div><!-- /btn-group -->	
</nav>
<!-- Navigation bar ends-->

<!-- Side menu bar starts->
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion" style="display:hidden">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-user">
                            </span>Membership</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-plus"></span><a href="member_add_new.php?c=1">New Member</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-eye-open"></span><a href="member_view.php?c=1">View Member</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-usd">
                            </span>Loan</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-plus"></span><a href="loan_add_new.php?c=2">New Loan</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-eye-open"></span><a href="loan_view.php?c=2">View Loan</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"><span class="glyphicon glyphicon-record">
                            </span>Subcription</a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-plus"></span><a href="subcription_add_new.php?c=6">New Subcription</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-eye-open"></span><a href="subcription_view.php?c=6">View Subcription</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-transfer">
                            </span>Payment</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-usd"></span><a href="payment.php?c=3">Loan</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-record"></span><a href="subcription_payment.php?c=3">Subcription</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
                            </span>Loan Reports</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-user"></span><a href="member_loan_report.php?c=4&search">Member Report</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-time"></span><a href="daily_report.php?c=4">Daily Report</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-time"></span><a href="range_report.php?c=4">Range Report</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-exclamation-sign"></span><a href="late_payment.php?c=4">Defaulter Report</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"><span class="glyphicon glyphicon-file">
                            </span>Subcription Reports</a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-user"></span><a href="member_subcription_report.php?c=7&search">Member Report</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-time"></span><a href="subcription_daily_report.php?c=7">Daily Report</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-time"></span><a href="subcription_range_report.php?c=7">Range Report</a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-exclamation-sign"></span><a href="subcription_late_payment.php?c=7">Defaulter Report</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="glyphicon glyphicon-cog">
                            </span>Admin</a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-wrench"></span><a href="admin_account_setting.php?c=5">Account Settings</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-plus"></span><a href="admin_add_admin.php?c=5">Add Admin</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-trash"></span><a href="admin_delete.php?c=5">
                                            Delete Admin</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-hdd"></span><a href="admin_view_database.php?c=5">View Database</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon glyphicon-download-alt"></span><a href="database_backup.php?c=5">Backup/Restore Database</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-log-out"></span><a href="login.php?logout">Sign out</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Side menu bar ends-->

<!-- Quick shortcut menu starts->
        <div class="col-md-9">
            <div class="panel panel-primary" id="quickShort">
                <div class="panel-heading">
                    <h3 class="panel-title">
                         <a data-toggle="collapse" data-parent="#quickShort" href="#collapseShort"><span class="glyphicon glyphicon-bookmark"></span> Quick Shortcuts</h3></a>
                </div>
				<div id="collapseShort" class="panel-collapse collapse">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-6 col-md-6">
							  <a href="member_add_new.php?c=1" class="btn btn-danger btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-user"></span><br/>Add Member</a>
							  <a href="member_view.php?c=1" class="btn btn-warning btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-eye-open"></span> <br/>View Member</a>
							  <a href="daily_report.php?c=4" class="btn btn-primary btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-file"></span> <br/>Daily loan report</a>
							  <a href="subcription_daily_report.php?c=7" class="btn btn-info btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-file"></span> <br/>Daily subcription report</a>
							</div>
							<div class="col-xs-6 col-md-6">
							  <a href="loan_add_new.php?c=2" class="btn btn-success btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-plus"></span> <br/>Add Loan</a>
							  <a href="subcription_add_new.php?c=6" class="btn btn-info btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-record"></span> <br/>Add Subcription </a>
							  <a href="payment.php?c=3" class="btn btn-warning btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-transfer"></span> <br/>Loan Payment</a>
							  <a href="subcription_payment.php?c=3" class="btn btn-primary btn-lg" role="button" style="font-size: 16px;"><span class="glyphicon glyphicon-transfer"></span> <br/>Subcription Payment</a>
							</div>
						</div>
						<a href="home.php" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-home"></span> Home</a>
					</div>
				</div>
            </div>
        </div>
<!-- Quick shortcut menu ends-->
