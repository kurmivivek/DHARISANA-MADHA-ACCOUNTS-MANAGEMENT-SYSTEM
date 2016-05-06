<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
	date_default_timezone_set("Asia/Kolkata");
	$db = new SQLite3('../db/core.db') or die('Unable to open database');
	$result = $db->query("SELECT *,strftime('%d-%m-%Y',date) as date FROM record WHERE id='".$_GET['id']."'") or die("Query failed");
	if ($row = $result->fetchArray())
	{
		$type=$row['type'];
		$date=$row['date'];
		$name=$row['name'];
		$amount=$row['amount'];
		$receipt_no=$row['receipt_no'];
		$bill_no=$row['bill_no'];
		$ledger=$row['ledger_page_no'];
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-md-12 ">
			<div class="panel panel-primary" >
				<div class="panel-heading">
					<h3><strong>Edit Record</strong></h3>
				</div>
				<div class="panel-body">
					<div id="result"></div>
					<form class="form-horizontal col-md-12 col-sm-12" role="form" id="recordEditForm" autocomplete="off">
							  <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
							  <div class="col-md-6 col-sm-12">
							  	  <div class="form-group">
									<label for="date" class="col-md-4 control-label" > Date</label>
									<div class="col-md-6">
									  <input class="form-control" name="date" id="date" placeholder="DD-MM-YYYY" required	data-fv-notempty-message="Date is required" value="<?php echo $date;?>">
									</div>
								  </div>
								  <div class="form-group">
									<label for="name" class="col-md-4 control-label"> Name</label>
									  <div class="col-md-8">
										<input  class="form-control" name="name" id="name" placeholder="Name" required	data-fv-notempty-message="Name is required" value="<?php echo $name;?>">
									  </div>
								  </div>					  
								  <div class="form-group">
									<label for="amount" class="col-md-4 control-label"> Amount</label>
									  <div class="col-md-8">
										<input class="form-control" name="amount" id="amount" placeholder="amount" onblur="format_amount();" required	data-fv-notempty-message="Amount is required" value="<?php echo $amount;?>">
									  </div>
								  </div>			  
							</div>
							<div class="col-md-6 col-sm-12">
							  <div class="form-group">
								<label for="receipt" class="col-md-4 control-label" > Receipt No.</label>
								  <div class="col-md-8">
								  <input class="form-control" name="receipt" id="receipt" placeholder="Receipt No." value="<?php echo $receipt_no;?>">
								</div>
							  </div>
							  <?php if($type=="expenditure"){?>
							  <div class="form-group">
								<label for="bill" class="col-md-4 control-label" > Bill No.</label>
								  <div class="col-md-8">
								  <input class="form-control" name="bill" id="bill" placeholder="Bill No." value="<?php echo $bill_no;?>">
								</div>
							  </div>
							  <?php }?>
							  <div class="form-group">
								<label for="ledger" class="col-md-4 control-label" > Page No. of Ledger</label>
								  <div class="col-md-8">
								  <input class="form-control" name="ledger" id="ledger" placeholder="Page No. of Ledger" required data-fv-notempty-message="The Page No. of Ledger is required" value="<?php echo $ledger;?>">
								</div>
							  </div>
						</div>
						  <div class="col-md-12">			
							  <div class="form-group">
							  	<div class="col-md-offset-2 col-md-2">
									<button type="button" class="btn-lg btn-primary" onclick="window.location.replace(document.referrer);"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
								</div>
							  	<div class="col-md-4">
								  <a href="ajax/delete_record.php?id=<?php echo $_GET['id'].'&url='.$_SERVER['HTTP_REFERER'];?>" onclick="return confirm ('Are you sure you want to delete this Record!')"><button type="button" class="btn-lg btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Record</button></a>
								</div>
								<div class="col-md-4">
								  <button type="submit" name="submit" class="btn-lg btn-success"><span class="glyphicon glyphicon-floppy-open"></span> Edit Record</button>
								</div>
							  </div>
							</div>
					</form>
				</div>
			</div>
		</div>
	 <script>
	$(function() {
	$( "#date" ).datepicker({ dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		onSelect: function () {
		$('#recordEditForm').formValidation('updateStatus', 'date', 'NOT_VALIDATED')
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
	$("#date").datepicker(
    "setDate", "<?php echo $date;?>");
    $('#recordEditForm').formValidation({
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
            // Get the form instance
            var $form = $(e.target);

            // Get the FormValidation instance
            var bv = $form.data('formValidation');

            // Use Ajax to submit form data
            var jqxhr =$.post("ajax/edit_record.php", $form.serialize() , function(result) {
                // ... Process the result ...
                if(result['success']){
                	swal({  title: "Success!",   
                			text: "The record has been sucessfully edited",
                			type: "success",   
                			timer: 2000,   
                			allowOutsideClick: true
                			 });
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
        });
	});
    $("form#recordEditForm").keydown(function(event){//prevent form submit on enter 
	    if( (event.keyCode == 13)  ) {
	      event.preventDefault();
	      return false;
	    }
	});
</script>

<?php include ("footer.php");?>
