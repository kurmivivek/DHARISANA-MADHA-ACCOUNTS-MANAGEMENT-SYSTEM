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
					<h3><strong>Add Church Income</strong></h3>
				</div>
				<div class="panel-body">
					<div id="result"></div>
					<form class="form-horizontal col-md-12 col-sm-12" role="form" id="churchIncomeForm" autocomplete="off">
							  <input type="hidden" name="category" value="church">
							  <input type="hidden" name="type" value="income">
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
							<div class="col-md-6 col-sm-12">
							  <div class="form-group">
								<label for="receipt" class="col-md-4 control-label" > Receipt No.</label>
								  <div class="col-md-8">
								  <input class="form-control" name="receipt" id="receipt" placeholder="Receipt No.">
								</div>
							  </div>
							  <div class="form-group">
								<label for="ledger" class="col-md-4 control-label" > Page No. of Ledger</label>
								  <div class="col-md-8">
								  <input class="form-control" name="ledger" id="ledger" placeholder="Page No. of Ledger" required data-fv-notempty-message="The Page No. of Ledger is required">
								</div>
							  </div>
						</div>
						  <div class="col-md-12">			
							  <div class="form-group">
							  	<div class="col-md-offset-2 col-md-4">
								  <button type="reset" class="btn-lg btn-primary" onclick="$('#churchIncomeForm').data('formValidation').resetForm();"><span class="glyphicon glyphicon-repeat"></span> Clear Form</button>
								</div>
								<div class="col-md-4">
								  <button type="submit" name="submit" class="btn-lg btn-success"><span class="glyphicon glyphicon-floppy-open"></span> Add Record</button>
								</div>
							  </div>
							</div>
					</form>
					<div class="col-md-offset-2 col-md-9">
						<h3 style="text-align:center"><strong>Recent income records</strong></h3>
						<table class="table table-striped table-hover" id="recordTable">
						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Receipt #</th>
								<th>Amount</th>
								<th>Page No of Ledger</th>
								<th>Operator Name</th>
								<th>Entry Date</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$db = new SQLite3('../db/core.db') or die('Unable to open database');
						$result = $db->query("SELECT *,strftime('%d-%m-%Y',date) as date,strftime('%d-%m-%Y %H:%M',timestamp) as entry_date FROM (SELECT * FROM record WHERE category='church' and type='income' ORDER BY id DESC LIMIT 5) ORDER BY id ASC") or die("Query failed");
						while ($row = $result->fetchArray())
						{
						echo "<tr><td>{$row['date']}</td><td>{$row['name']}</td><td>{$row['receipt_no']}</td><td>{$row['amount']}</td><td>{$row['ledger_page_no']}</td><td>{$row['operator_name']}</td><td>{$row['entry_date']}</td><td><a href='edit_record.php?id={$row['id']}' class='btn btn-info' role='button'>Edit</a></td></tr>";
						}
						?>
						</tbody>
						</table>
					</div>
					<div class="col-md-offset-2 col-md-8">
						<div class="col-md-6">
							<h3 style="text-align:center"><strong><?php echo date('F',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));?>'s Accounts Record</strong></h3>
							<?php 
							$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and strftime('%Y-%m',date)=strftime('%Y-%m','now','-1 month','localtime')") or ($income=0);
							$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and strftime('%Y-%m',date)=strftime('%Y-%m','now','-1 month','localtime')") or ($Expenditure=0);
							$balance=$income-$expenditure
							?>
							<span class="col-md-7" style="text-align:right"><strong>Total Income: ₹</strong></span><span><?php echo number_format((float)$income, 2, '.', '');?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Total Expenditure: ₹</strong></span><span><?php echo number_format((float)$expenditure, 2, '.', '');?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Balance: ₹</strong></span><span><?php echo number_format((float)$balance, 2, '.', '');?></span>
						</div>
						<div class="col-md-6">
							<h3 style="text-align:center"><strong><?php echo date('F');?>'s Accounts Record</strong></h3>
							<?php 
							$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income' and strftime('%Y-%m',date)=strftime('%Y-%m','now','localtime')") or ($income=0);
							$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure' and strftime('%Y-%m',date)=strftime('%Y-%m','now','localtime')") or ($Expenditure=0);
							$balance=$income-$expenditure
							?>
							<span class="col-md-7" style="text-align:right"><strong>Total Income: ₹</strong></span><span id="income"><?php echo number_format((float)$income, 2, '.', '');?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Total Expenditure: ₹</strong></span><span id="expenditure"><?php echo number_format((float)$expenditure, 2, '.', '')?></span><br/>
							<span class="col-md-7" style="text-align:right"><strong>Balance: ₹</strong></span><span id="balance"><?php echo number_format((float)$balance, 2, '.', '');?></span>
						</div>
						<div class="col-md-12">		
 							<?php 		
 							$income = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='income'") or ($income=0);		
 							$expenditure = $db->querySingle("SELECT SUM(amount) FROM record WHERE category='church' and type='expenditure'") or ($Expenditure=0);		
 							$balance=$income-$expenditure;		
 							?>		
 							<span class="col-md-12" style="text-align:center"><strong>Church Cumulative Bank Balance: ₹ </strong><span id="total_balance"><?php echo number_format((float)$balance, 2, '.', '');?></span></span>		
 						</div>
					</div>
				</div>
			</div>
		</div>
	 <script>
	$(function() {
	$( "#date" ).datepicker({ dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		onSelect: function () {
		$('#churchIncomeForm').formValidation('updateStatus', 'date', 'NOT_VALIDATED')
       .formValidation('validateField', 'date');}
		 });
	});
	</script>
	<script>
	function format_amount()
	{
		if($.isNumeric($('#amount').val()))
		{
			$('#amount').val(parseFloat($('#amount').val()).toFixed(2));
		}
	}
	function pad(d) {
    	return (d < 10) ? '0' + d.toString() : d.toString();
	}
	</script>
<script>
$(document).ready(function()	{
	$(function(){
		getJoinDate();
	});
    $('#churchIncomeForm').formValidation({
	    	icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields:{
              	date:{
				 	validators: {
                    	date: {
	                        format: 'DD-MM-YYYY',
	                        message: 'The value is not a valid date.Should be of form DD-MM-YYYY'
                    	}
                	}
              	},
                amount:{
					validators:{
						numeric: {
                            message: 'The value is not a number',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
					}
				}
			}
	    })
		.on('success.field.fv', function(e, data) {
            // If the field is empty
                var $parent = data.element.parents('.form-group');

                // Remove the has-success class
                $parent.removeClass('has-success');

                // Hide the success icon
                data.element.data('fv.icon').hide();
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();
            
            //check if entry for the receipt_no already exists
            var validRN=true;
            var checkRN=$.ajax({
				type: "GET",
				url: "ajax/check_record.php",
				data: {category: "church",type: "income",receipt: $("#receipt").val()}, 
				cache: false,
				async: false,
				success: function(result){
					if(result['valid']!=true){
	                	validRN=false;
	             		var r = confirm("An record with the same Receipt No. already exists for the given month! Are you sure you want to add this record?");
             		    if (r == true) {
             		        validRN=true;
	             		}
	             		else{
	             			$("#churchIncomeForm button[type=submit]").removeAttr('disabled');
	             		}   	
	                }
				}
				});
            if(validRN){
            // Get the form instance
            var $form = $(e.target);

            // Get the FormValidation instance
            var bv = $form.data('formValidation');

            // Use Ajax to submit form data
            var jqxhr =$.post("ajax/add_record.php", $form.serialize() , function(result) {
                // ... Process the result ...
                if(result['success']){
                	var d = new Date();
                	$('#recordTable tbody').append("<tr class='success'><td>"+result['date']+"</td><td>"+result['name']+"</td><td>"+result['receipt_no']+"</td><td>"+result['amount']+"</td><td>"+result['ledger_page_no']+"</td><td><?php echo $_COOKIE['admin_name']?></td><td>"+pad(d.getDate())+"-"+pad(d.getMonth()+1)+"-"+d.getFullYear()+" "+pad(d.getHours())+":"+pad(d.getMinutes())+"</td><td><a href='edit_record.php?id="+result['id']+"' class='btn btn-info' role='button'>Edit</a></td></tr>");
                	var total_balance=$("#total_balance").text();
                	var balance=$("#balance").text();
                	var income=$("#income").text();
                	var amount=result['amount'];
                	total_balance=parseFloat(total_balance)+parseFloat(amount);
                	balance=parseFloat(balance)+parseFloat(amount);
                	income=parseFloat(income)+parseFloat(amount);
                	$("#total_balance").text(total_balance.toFixed(2));
                	$("#balance").text(balance.toFixed(2));
                	$("#income").text(income.toFixed(2));
                	swal({  title: "Success!",   
                			text: "The record has been sucessfully added",
                			type: "success",   
                			timer: 2000,   
                			allowOutsideClick: true
                			 });
                	$('form#churchIncomeForm').data('formValidation').resetForm();
  		   			$('form#churchIncomeForm')[0].reset();
  		   			getJoinDate();
  		   		}
               	else
                swal({  title: "Error!",   
                			text: result['msg'],
                			type: "error",     
                			allowOutsideClick: true
                			 });
            }, "json")
            .fail(function() {
		    	swal({  title: "Error!",   
                			type: "error",   
                			timer: 2000,   
                			allowOutsideClick: true
                			 });
		  	});
        	}
        });
	});
	//to populate the date input to the current date
    function getJoinDate()
    {
		$('#date').datepicker('setDate', new Date());
		$('#churchIncomeForm').formValidation('updateStatus', 'date', 'NOT_VALIDATED')
			.formValidation('validateField', 'date');
    }
    $("form#churchIncomeForm").keydown(function(event){//prevent form submit on enter 
	    if( (event.keyCode == 13)  ) {
	      event.preventDefault();
	      return false;
	    }
	});
</script>

<?php include ("footer.php");?>
