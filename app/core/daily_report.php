<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-sm-9 col-md-9 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Daily Payment Report</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
					<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Memb #</th>
							<th>Member Name</th>
							<th>Loan #</th>
							<th>Amount</th>
							<th>Balance</th>
							<th>Interest</th>
							<th>Admin Name</th>
							<th>Payment Date</br>(YYYY-MM-DD H:M:S)</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$db = new SQLite3('../db/core.db') or die('Unable to open database');
					$result = $db->query("SELECT *,strftime('%d-%m-%Y %H:%M:%S',payment_date) as payment_date  FROM cms_payment WHERE strftime('%Y-%m-%d',payment_date) BETWEEN date('now','localtime') AND date('now','localtime') ORDER BY payment_date DESC") or die("Query failed");
					while ($row = $result->fetchArray())
					{
					echo "<tr><td>{$row['mem_no']}</td><td>{$row['mem_name']}</td><td>{$row['loan_no']}</td><td>{$row['amount']}</td><td>{$row['balance']}</td><td>{$row['interest']}</td><td>{$row['admin_name']}</td><td>{$row['payment_date']}</td><td><a href='payment_edit.php?sel_payment_id={$row['payment_id']}' class='btn btn-info' role='button'>Edit</a></td></tr>";
					}
					$collection_loan = $db->querySingle("SELECT SUM(amount) FROM cms_payment WHERE strftime('%Y-%m-%d',payment_date) BETWEEN date('now','localtime') AND date('now','localtime')") or ($collection_loan=0);
					$collection_interest = $db->querySingle("SELECT SUM(interest) FROM cms_payment WHERE strftime('%Y-%m-%d',payment_date) BETWEEN date('now','localtime') AND date('now','localtime')") or ($collection_interest=0);
					$total=$collection_interest+$collection_loan;
					?>
					</tbody>
					</table>
					
					<h4><strong>Loan collection Rs.: <?php echo $collection_loan;?></strong></h4>
					<h4><strong>Interest collection Rs.: <?php echo $collection_interest;?></strong></h4>
					<h4><strong>Total collection Rs.: <?php echo $total;?></strong></h4>
					</div>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
