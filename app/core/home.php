<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
	$db = new SQLite3('../db/core.db') or die('Unable to open database');
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-sm-12 col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Home Screen</h3>
				</div>
				<div class="panel-body">
						Welcome to the DHARISANA MADHA Accounts Managment System!
					<div class="col-md-12">
						<canvas id="churchChart"></canvas>
					</div>
					<div class="col-md-12">
						<canvas id="schoolChart"></canvas>
					</div>
				</div>
			</div>
		</div>
<script>
var ctx_church = document.getElementById("churchChart");
var ctx_school = document.getElementById("schoolChart");
var churchChart = new Chart(ctx_church, {
    type: 'line',
    data: {
    	labels: [<?php for ($i=1;$i<=12;$i++){
        					echo "\"".date("F",mktime(0,0,0,$i,1,date("Y"))).",".date("Y")."\",";
        				}?>],
	    datasets: [
	        {
	            label: "Church Income ₹",
	            fill: true,
	            lineTension: 0,
	            backgroundColor: "rgba(196, 227, 243,0.4)",
	            borderColor: "rgba(196, 227, 243,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(196, 227, 243,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(196, 227, 243,1)",
	            pointHoverBorderColor: "rgba(196, 227, 243,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php for ($i=1;$i<=12;$i++){
        					$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and strftime('%Y-%m',date)='".date('Y')."-".date('m',mktime(0,0,0,$i,1,date('Y')))."'") or ($income=0);
        					echo $income.",";
        				}?>],
	        },
	        {
	            label: "Church Expenditure ₹",
	            fill: true,
	            lineTension: 0,
	            backgroundColor: "rgba(245, 230, 155,0.4)",
	            borderColor: "rgba(245, 230, 155,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(245, 230, 155,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(245, 230, 155,1)",
	            pointHoverBorderColor: "rgba(245, 230, 155,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php for ($i=1;$i<=12;$i++){
        					$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and strftime('%Y-%m',date)='".date('Y')."-".date('m',mktime(0,0,0,$i,1,date('Y')))."'") or ($income=0);
        					echo $expenditure.",";
        				}?>],
	        }
    	]
    }
});
var schoolChart = new Chart(ctx_school, {
    type: 'line',
    data: {
    	labels: [<?php for ($i=1;$i<=12;$i++){
        					echo "\"".date("F",mktime(0,0,0,$i,1,date("Y"))).",".date("Y")."\",";
        				}?>],
	    datasets: [
	        {
	            label: "School Income ₹",
	            fill: true,
	            lineTension: 0,
	            backgroundColor: "rgba(196, 227, 243,0.4)",
	            borderColor: "rgba(196, 227, 243,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(196, 227, 243,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(196, 227, 243,1)",
	            pointHoverBorderColor: "rgba(196, 227, 243,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php for ($i=1;$i<=12;$i++){
        					$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='income' and strftime('%Y-%m',date)='".date('Y')."-".date('m',mktime(0,0,0,$i,1,date('Y')))."'") or ($income=0);
        					echo $income.",";
        				}?>],
	        },
	        {
	            label: "School Expenditure ₹",
	            fill: true,
	            lineTension: 0,
	            backgroundColor: "rgba(245, 230, 155,0.4)",
	            borderColor: "rgba(245, 230, 155,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(245, 230, 155,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(245, 230, 155,1)",
	            pointHoverBorderColor: "rgba(245, 230, 155,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php for ($i=1;$i<=12;$i++){
        					$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='school' and type='expenditure' and strftime('%Y-%m',date)='".date('Y')."-".date('m',mktime(0,0,0,$i,1,date('Y')))."'") or ($income=0);
        					echo $expenditure.",";
        				}?>],
	        }
    	]
    }
});
</script>
<?php include ("footer.php");?>
