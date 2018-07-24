<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
	date_default_timezone_set("Asia/Kolkata");
	if(isset($_POST['month']))
	{
		$_POST['month']=sprintf("%02d", $_POST['month']);
		$noOfDays=date("t",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
		$monthName=date("F",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
		$month=date("m",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
		$year=date("Y",mktime(0, 0, 0, $_POST['month'], 1,   $_POST['year']));
	}
	else
	{
		$noOfDays=date("t");
		$monthName=date("F");
		$month=date("m");
		$year=date("Y");
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-md-12 ">
			<div class="panel panel-primary" >
				<div class="panel-heading">
					<h3><strong>View Church Records</strong></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal col-md-12 col-sm-12" role="form" id="ChurchViewForm" autocomplete="off" method="post">
						<div class="form-group">
						  <label for="month" class="col-md-offset-2 col-md-3 control-label"> VIEW REPORT FOR </label>
						    <div class="col-md-3">
						       <select data-placeholder="Month" class="chosen-select" name="month" id="month" style="width:100px" required>
						          <option value="1">January</option>
						          <option value="2">February</option>
						          <option value="3">March</option>
						          <option value="4">April</option>
						          <option value="5">May</option>
						          <option value="6">June</option>
						          <option value="7">July</option>
						          <option value="8">August</option>
						          <option value="9">September</option>
						          <option value="10">October</option>
						          <option value="11">November</option>
						          <option value="12">December</option>
						      </select>
						       <select data-placeholder="Year" class="chosen-select" name="year" id="year" style="width:100px" required>
						          <option value="2015">2015</option>
						          <option value="2016">2016</option>
						          <option value="2017">2017</option>
						          <option value="2018">2018</option>
						          <option value="2019">2019</option>
						          <option value="2020">2020</option>
						          <option value="2021">2021</option>
						          <option value="2022">2022</option>
						          <option value="2023">2023</option>
						          <option value="2024">2024</option>
						          <option value="2025">2025</option>
						          <option value="2026">2026</option>
						          <option value="2027">2027</option>
						          <option value="2028">2028</option>
						          <option value="2029">2029</option>
						          <option value="2030">2030</option>
						          <option value="2031">2031</option>
						          <option value="2032">2032</option>
						          <option value="2033">2033</option>
						          <option value="2034">2034</option>
						          <option value="2035">2035</option>
						          <option value="2036">2036</option>
						      </select>
						    </div>
						    <div class="col-md-2">
						      <button type="submit" name="submit" class="btn btn-success">Search <span class="glyphicon glyphicon-search"></span></button>
						    </div>
						</div>
					</form>
					<div class="col-md-offset-1 col-md-10">
						<h3 style="text-align:center"><strong>Church records for <?php echo $monthName.",".$year;?></strong></h3>
						<table class="table table-striped table-hover table-bordered" id="recordTable">
						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Receipt # /<br/> Voucher #</th>
								<th>Income ₹</th>
								<th>Expenditure ₹</th>
								<th>Bill No</th>
								<th>Page No of Ledger</th>
								<th>Operator Name</th>
								<th>Entry Date</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$db = new SQLite3('../db/core.db') or die('Unable to open database');
						$result = $db->query("SELECT *,strftime('%d-%m-%Y',date) as date,strftime('%d-%m-%Y %H:%M',timestamp) as entry_date FROM record WHERE category='church' and strftime('%Y-%m',date)='".$year."-".$month."' ORDER BY id") or die("Query failed");
						while ($row = $result->fetchArray())
						{
							if($row['type']=='income'){
							echo "<tr><td>{$row['date']}</td><td>{$row['name']}</td><td>{$row['receipt_no']}</td><td class='amount'>".formatInIndianStyle(number_format((float)$row['amount'], 2, '.', ''))."</td><td></td><td></td><td>{$row['ledger_page_no']}</td><td>{$row['operator_name']}</td><td>{$row['entry_date']}</td><td><a href='edit_record.php?id={$row['id']}' class='btn btn-info' role='button'>Edit</a></td></tr>";
							}
							else{
							echo "<tr><td>{$row['date']}</td><td>{$row['name']}</td><td>{$row['receipt_no']}</td><td></td><td class='amount'>".formatInIndianStyle(number_format((float)$row['amount'], 2, '.', ''))."</td><td>{$row['bill_no']}</td><td>{$row['ledger_page_no']}</td><td>{$row['operator_name']}</td><td>{$row['entry_date']}</td><td><a href='edit_record.php?id={$row['id']}' class='btn btn-info' role='button'>Edit</a></td></tr>";
							}
						}
						?>
						<tr class="success">
							<td colspan="3" style="text-align:right"><strong>TOTAL ₹ :</strong></td>
							<td class='amount'><strong><?php 
								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($income=0);
            					echo formatInIndianStyle(number_format((float)$income, 2, '.', ''));
							?></strong></td>
							<td class='amount'><strong><?php 
								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($expenditure=0);
            					echo formatInIndianStyle(number_format((float)$expenditure, 2, '.', ''));
							?></strong></td>
							<td class='amount' colspan="5" style="text-align:center"><strong><?php echo $monthName;?>'s Church Bank balance ₹ : <?php echo formatInIndianStyle(number_format((float)$income-(float)$expenditure, 2, '.', ''));?></strong></td>
						</tr>
						<tr class="info">		
 							<td class='amount' data-toggle="tooltip" data-original-title="Bank balance of all months combined" colspan="10" style="text-align:center"><strong>Church Cumulative bank balance ₹ : 	
 							<?php 		
 								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and date < date('".$year."-".$month."-01','start of month','+1 month')") or ($income=0);		
 								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and date < date('".$year."-".$month."-01','start of month','+1 month')") or ($expenditure=0);		
 								$balance=$income-$expenditure;		
 								echo formatInIndianStyle(number_format((float)$balance, 2, '.', ''));		
 							?></strong></td>		
 						</tr>
						</tbody>
						</table>
					</div>
					<form target="_blank" action="pdf_report.php" method="post" lass="form-horizontal col-md-12 col-sm-12" role="form">
						<input type="hidden" name="category" value="church">
						<input type="hidden" name="month" value="<?php echo $month;?>">
						<input type="hidden" name="year" value="<?php echo $year;?>">
						<div class="col-md-offset-5 col-md-2">
						      <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-print"></span><strong> Print Report</strong></button>
						</div>
					</form>
				</div>
			</div>
		</div>
<script>
$( document ).ready(function() {
    var d = new Date();
    var month=d.getMonth();
    var year=d.getFullYear();
    $('#month option[value='+month+']').prop('selected', 'selected')
    $('#year option[value='+year+']').prop('selected', 'selected')
});
$(function() {
    $(".chosen-select").chosen({disable_search: false});
    });
</script>
<?php $db->close(); ?>
<?php include ("footer.php");?>