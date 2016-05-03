<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
	date_default_timezone_set("Asia/Kolkata");
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-md-12 ">
			<div class="panel panel-primary" >
				<div class="panel-heading">
					<h3><strong>Bank Income View</strong></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal col-md-12 col-sm-12" role="form" id="schoolExpenditureForm" autocomplete="off">
							  <div class="col-md-6 col-sm-12">
							  	  <div class="form-group">
									<label for="date" class="col-md-4 control-label" > Date</label>
									<div class="col-md-6">
									  <input class="form-control" name="date" id="date" placeholder="DD-MM-YYYY" required	data-fv-notempty-message="Date is required">
									</div>
								  </div>
								  <div class="form-group">
									<label for="name" class="col-md-4 control-label"> Name</label>
									  <div class="col-md-8">
										<input  class="form-control" name="name" id="name" placeholder="Name" required	data-fv-notempty-message="Name is required">
									  </div>
								  </div>					  
								  <div class="form-group">
									<label for="amount" class="col-md-4 control-label"> Amount</label>
									  <div class="col-md-8">
										<input class="form-control" name="amount" id="amount" placeholder="amount" onblur="format_amount();" required	data-fv-notempty-message="Amount is required">
									  </div>
								  </div>			  
							</div>
					</form>
					<div class="col-md-offset-4 col-md-4">
						<h3 style="text-align:center"><strong>Recent expenditure records</strong></h3>
						<table class="table table-striped table-hover" id="recordTable">
						<thead>
							<tr>
								<th>Date</th>
								<th>Category</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$db = new SQLite3('../db/core.db') or die('Unable to open database');
						$result = $db->query("SELECT strftime('%d-%m-%Y',date) as date,category,sum(amount) as amount from record where type='income' and strftime('%Y-%m',date)=strftime('%Y-%m','now','localtime') group by strftime('%Y-%m-%d',date),category") or die("Query failed");
						while ($row = $result->fetchArray())
						{
							if($row['category']=='church')
								echo "<tr class='info'><td>{$row['date']}</td><td>{$row['category']}</td><td>{$row['amount']}</td></tr>";
							else	
								echo "<tr class='warning'><td>{$row['date']}</td><td>{$row['category']}</td><td>{$row['amount']}</td></tr>";
						}
						?>
						</tbody>
						</table>
					</div>
					<div class="col-md-offset-3 col-md-8">
						<div class="col-md-6">
							<h3 style="text-align:center"><strong><?php echo date('F',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));?>'s Accounts Record</strong></h3>
							<?php 
							$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income' and strftime('%Y-%m',date)=strftime('%Y-%m','now','-1 month','localtime')") or ($income=0);
							$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='expenditure' and strftime('%Y-%m',date)=strftime('%Y-%m','now','-1 month','localtime')") or ($Expenditure=0);
							$balance=$income-$expenditure
							?>
							<span class="col-md-7" style="text-align:right"><strong>Total Income: ₹</strong></span><span><?php echo number_format((float)$income, 2, '.', '');?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Total Expenditure: ₹</strong></span><span><?php echo number_format((float)$expenditure, 2, '.', '');?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Balance: ₹</strong></span><span><?php echo number_format((float)$balance, 2, '.', '');?></span>
						</div>
						<div class="col-md-6">
							<h3 style="text-align:center"><strong><?php echo date('F');?>'s Accounts Record</strong></h3>
							<?php 
							$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income' and strftime('%Y-%m',date)=strftime('%Y-%m','now','localtime')") or ($income=0);
							$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='expenditure' and strftime('%Y-%m',date)=strftime('%Y-%m','now','localtime')") or ($Expenditure=0);
							$balance=$income-$expenditure
							?>
							<span class="col-md-7" style="text-align:right"><strong>Total Income: ₹</strong></span><span id="income"><?php echo number_format((float)$income, 2, '.', '');?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Total Expenditure: ₹</strong></span><span id="expenditure"><?php echo number_format((float)$expenditure, 2, '.', '')?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Balance: ₹</strong></span><span id="balance"><?php echo number_format((float)$balance, 2, '.', '');?></span>
						</div>
						<div class="col-md-12">
							<?php 
							$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income'") or ($income=0);
							$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='expenditure'") or ($Expenditure=0);
							$balance=$income-$expenditure
							?>
							<span class="col-md-12" style="text-align:center"><strong>School Bank Balance: ₹ </strong><span id="total_balance"><?php echo number_format((float)$balance, 2, '.', '');?></span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>