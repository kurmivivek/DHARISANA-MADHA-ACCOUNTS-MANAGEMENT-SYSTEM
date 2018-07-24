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
					<h3>Errors</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
					<h3>Following Entries have date either missing or in invalid format.Please correct the date by selecting the edit option next to the entry.<br/>Enter the date in dd-mm-yyyy format (ex. 01-01-2016)</h3>
					<br/>
					<table class="table table-striped table-hover" id="recordTable">
					<thead>
						<tr>
							<th>Date</th>
							<th>Name</th>
							<th>Receipt #</th>
							<th>Amount</th>
							<th>Bill #</th>
							<th>Page No of Ledger</th>
							<th>Operator Name</th>
							<th>Entry Date</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$db = new SQLite3('../db/core.db') or die('Unable to open database');
					$result = $db->query("SELECT *,strftime('%d-%m-%Y',date) as date,strftime('%d-%m-%Y %H:%M',timestamp) as entry_date FROM record WHERE strftime('%d-%m-%Y',date) IS NULL") or die("Query failed");
					while ($row = $result->fetchArray())
					{
					echo "<tr><td>{$row['date']}</td><td>{$row['name']}</td><td>{$row['receipt_no']}</td><td class='amount'>".formatInIndianStyle(number_format((float)$row['amount'], 2, '.', ''))."</td><td>{$row['bill_no']}</td><td>{$row['ledger_page_no']}</td><td>{$row['operator_name']}</td><td>{$row['entry_date']}</td><td><a href='edit_record.php?id={$row['id']}' class='btn btn-info' role='button'>Edit</a></td></tr>";
					}
					?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
<?php include ("footer.php");?>
