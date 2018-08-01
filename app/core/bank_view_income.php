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
					<h3><strong>Bank Income View</strong></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal col-md-12 col-sm-12" role="form" id="incomeViewForm" autocomplete="off" method="post">
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
					<div class="col-md-offset-4 col-md-5">
						<h3 style="text-align:center"><strong>Income records for <?php echo $monthName.",".$year;?></strong></h3>
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
						$result = $db->query("SELECT strftime('%d-%m-%Y',date) as date,category,sum(amount) as amount from record where type='income' and strftime('%Y-%m',date)='".$year."-".$month."' group by strftime('%Y-%m-%d',date),category") or die("Query failed");
						while ($row = $result->fetchArray())
						{
							$row['amount']=formatInIndianStyle(number_format((float)$row['amount'], 2, '.', ''));
							if($row['category']=='church')
								echo "<tr class='info'><td>{$row['date']}</td><td>{$row['category']}</td><td class='amount'>{$row['amount']}</td></tr>";
							else	
								echo "<tr class='warning'><td>{$row['date']}</td><td>{$row['category']}</td><td class='amount'>{$row['amount']}</td></tr>";
						}
						?>
						<tr>
							<td colspan="2" style="text-align:right"><strong>Total Income ₹</strong></td>
							<td class='amount' data-toggle="tooltip" data-original-title="Total Income of Church and School Combined for the current month"><?php 
								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE type='income' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($income=0);
            					echo formatInIndianStyle(number_format((float)$income, 2, '.', ''));
							?></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right"><strong>Total Expenditure ₹</strong></td>
							<td class='amount' data-toggle="tooltip" data-original-title="Total Expenditure of Church and School Combined for the current month"><?php 
								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE type='expenditure' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($expenditure=0);
            					echo formatInIndianStyle(number_format((float)$expenditure, 2, '.', ''));
							?></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s Total Bank balance ₹</strong></td>
							<td class='amount' data-toggle="tooltip" data-original-title="Total Expenditure subtracted from the Income of Church and School Combined for the current month"><?php 
								$balance=$income-$expenditure;
            					echo formatInIndianStyle(number_format((float)$balance, 2, '.', ''));
							?></td>
						</tr>
						<tr><td></td><td></td><td></td></tr>
						<tr class="info">
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s Church Income ₹</strong></td>
							<td class='amount'><?php 
								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($income=0);
            					echo formatInIndianStyle(number_format((float)$income, 2, '.', ''));
							?></td>
						</tr>
						<tr class="info">
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s Church Expenditure ₹</strong></td>
							<td class='amount'><?php 
								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($expenditure=0);
            					echo formatInIndianStyle(number_format((float)$expenditure, 2, '.', ''));
							?></td>
						</tr>
						<tr class="success">
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s Church Bank balance ₹</strong></td>
							<td class='amount'><?php 
								$balance=$income-$expenditure;
            					echo formatInIndianStyle(number_format((float)$balance, 2, '.', ''));
							?></td>
						</tr>
						<tr>		
 							<td colspan="2" style="text-align:right"><strong>Church Cumulative bank balance ₹</strong></td>		
 							<td class='amount' data-toggle="tooltip" data-original-title="Bank balance of all months combined"><?php 		
 								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and date < date('".$year."-".$month."-01','start of month','+1 month')") or ($income=0);		
 								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and date < date('".$year."-".$month."-01','start of month','+1 month')") or ($expenditure=0);		
 								$balance=$income-$expenditure;		
 								echo formatInIndianStyle(number_format((float)$balance, 2, '.', ''));		
 							?></td>		
 						</tr>
 						<tr><td></td><td></td><td></td></tr>
						<tr class="warning">
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s School Income ₹</strong></td>
							<td class='amount'><?php 
								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($income=0);
            					echo formatInIndianStyle(number_format((float)$income, 2, '.', ''));
							?></td>
						</tr>
						<tr class="warning">
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s School Expenditure ₹</strong></td>
							<td class='amount'><?php 
								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='expenditure' and strftime('%Y-%m',date)='".$year."-".$month."'") or ($expenditure=0);
            					echo formatInIndianStyle(number_format((float)$expenditure, 2, '.', ''));
							?></td>
						</tr>
						<tr class="success">
							<td colspan="2" style="text-align:right"><strong><?php echo $monthName;?>'s School Bank balance ₹</strong></td>
							<td class='amount'><?php 
								$balance=$income-$expenditure;
            					echo formatInIndianStyle(number_format((float)$balance, 2, '.', ''));
							?></td>
						</tr>
						<tr>		
 							<td colspan="2" style="text-align:right"><strong>School Cumulative bank balance ₹</strong></td>		
 							<td class='amount' data-toggle="tooltip" data-original-title="Bank balance of all months combined"><?php 		
 								$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income' and date < date('".$year."-".$month."-01','start of month','+1 month')") or ($income=0);		
 								$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='expenditure' and date < date('".$year."-".$month."-01','start of month','+1 month')") or ($expenditure=0);		
 								$balance=$income-$expenditure;		
 								echo formatInIndianStyle(number_format((float)$balance, 2, '.', ''));		
 							?></td>		
 						</tr>
						</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<canvas id="incomeChart"></canvas>
					</div>
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
var ctx = document.getElementById("incomeChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php for ($i=1;$i<=$noOfDays;$i++)
        				echo "\"".$monthName." ".$i."\",";?>],
        datasets: [{
            label: "Church Income ₹",
            backgroundColor: "rgba(196, 227, 243,0.7)",
            borderColor: "rgba(196, 227, 243,1)",
            borderWidth: 1,
            hoverBackgroundColor: "rgba(196, 227, 243,0.95)",
            hoverBorderColor: "rgba(196, 227, 243,1)",
            data: [<?php for ($i=1;$i<=$noOfDays;$i++){
						$i=sprintf("%02d", $i);
            			$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and strftime('%Y-%m-%d',date)='".$year."-".$month."-".$i."'") or ($income=0);
            			echo $income.',';
            		}
            ?>],
        },
        {
            label: "School Income ₹",
            backgroundColor: "rgba(245, 230, 155,0.7)",
            borderColor: "rgba(245, 230, 155,1)",
            borderWidth: 1,
            hoverBackgroundColor: "rgba(245, 230, 155,0.95)",
            hoverBorderColor: "rgba(245, 230, 155,1)",
            data: [<?php for ($i=1;$i<=$noOfDays;$i++){
						$i=sprintf("%02d", $i);
            			$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income' and strftime('%Y-%m-%d',date)='".$year."-".$month."-".$i."'") or ($income=0);
            			echo $income.',';
            		}
            ?>],
        }]
    },
    options: {
    	stacked:true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<?php $db->close(); ?>
<?php include ("footer.php");?>