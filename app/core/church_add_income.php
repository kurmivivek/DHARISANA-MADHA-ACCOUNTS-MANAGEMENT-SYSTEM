<?php
	$message=-1;
	if(!isset($_COOKIE['admin_id']))
	{
			header("Location:login.php");
	}
?>
<?php include 'head.php'; ?>
<?php include 'menu.php'; ?>
        <div class="col-md-12 ">
			<div class="panel panel-primary" >
				<div class="panel-heading">
					<h3><strong>Add New Member</strong></h3>
				</div>
				<div class="panel-body">
					<div id="result"></div>
					<form class="form-horizontal col-md-12 col-sm-12" role="form" id="newMemberForm" autocomplete="off">
							  <div class="col-md-6 col-sm-12">
								  <div class="form-group">
									<label for="name" class="col-md-4 control-label"> Name</label>
									  <div class="col-md-8">
										<input  class="form-control" name="name" id="name" placeholder="Name" required	data-fv-notempty-message="The member's Name is required">
									  </div>
								  </div>					  
								  <div class="form-group">
									<label for="father_name" class="col-md-4 control-label"> Father Name</label>
									  <div class="col-md-8">
										<input class="form-control" name="father_name" id="father_name" placeholder="Father Name" required	data-fv-notempty-message="The member's Father name is required">
									  </div>
								  </div>			  
								  <div class="form-group">
									<label for="dob" class="col-md-4 control-label"> Date of Birth </label>
									  <div class="col-md-6">
										<input class="form-control" name="dob" id="dob" placeholder="DD-MM-YYYY" onchange="get_age()" required	data-fv-notempty-message="The member's DOB is required">
									  </div>
								  </div>
								  <div class="form-group">
									<label for="age" class="col-md-4 control-label"> Age</label>
									  <div class="col-md-4">
										<input class="form-control" name="age" id="age" placeholder="Age"  required	data-fv-notempty-message="The Member's age is required">
									  </div>
								  </div>						  
								  <div class="form-group">
									<label for="designation" class="col-md-4 control-label"> Designation / Profession</label>
									  <div class="col-md-8">
									  <input class="form-control" name="designation" id="designation" placeholder="Designation / Profession" >
									</div>
								  </div>
								  <div class="form-group">
									<label for="address" class="col-md-4 control-label"> Residential Address</label>
									  <div class="col-md-8">
									  <textarea class="form-control" name="address" id="address" placeholder="Member's Residential Address" required	data-fv-notempty-message="The Member's address is required"></textarea>
									</div>
								  </div>
								  <div class="form-group">
									<label for="inputPhone" class="col-md-4 control-label"> Contact</label>
									<div class="col-md-8">
									  <input class="form-control" id="inputPhone" name="phone" placeholder="Contact No." required	data-fv-notempty-message="The Member's contact number is required">
									</div>
								  </div>
								  <div class="form-group">
									<label for="share" class="col-md-4 control-label">Number of shares</label>
									  <div class="col-md-8">
									  <input class="form-control" name="share" id="share" placeholder="Share">
									</div>
								  </div>
							</div>
							<div class="col-md-6 col-sm-12">
							  <div class="form-group">
								<label for="reg_no" class="col-md-4 control-label" > Registration No.</label>
								  <div class="col-md-8">
								  <input class="form-control" name="reg_no" id="reg_no" placeholder="Registration No." required	data-fv-notempty-message="The Member's registration no. is required">
								</div>
							  </div>
							  <div class="form-group">
								<label for="mem_no" class="col-md-4 control-label" > Membership No.</label>
								  <div class="col-md-8">
								  <input class="form-control" name="mem_no" id="mem_no" placeholder="Membership No." required data-fv-notempty-message="The Member's Membership no. is required">
								</div>
							  </div>
							  <div class="form-group">
								<label for="join_date" class="col-md-4 control-label" > Join Date</label>
								<div class="col-md-6">
								  <input class="form-control" name="join_date" id="join_date" placeholder="DD-MM-YYYY" required	data-fv-notempty-message="The Join Date is required">
								</div>
							  </div>
							  <div style="border:1px solid #aaa;margin:0px -10px 10px -10px;padding:10px">
							    <div class="form-group">
								<label for="nominee" class="col-md-4 control-label"> Name of Heir/Nominee</label>
								  <div class="col-md-8">
									<input class="form-control" name="nominee" id="nominee" placeholder="Name of Nominee" required	data-fv-notempty-message="The Nominee name is required">
								  </div>
							  </div>
							    <div class="form-group">
								<label for="relation" class="col-md-4 control-label"> Relationship</label>
								  <div class="col-md-8">
									<input class="form-control" name="relation" id="relation" placeholder="Relationship to the nominee" required	data-fv-notempty-message="The relationship to nominee is required">
								  </div>
							  </div>
							</div>
							  <div style="border:1px solid #aaa;margin:0px -10px 10px -10px;padding:10px">
							    <div class="form-group">
								<label for="witness" class="col-md-4 control-label"> Name of Witness</label>
								  <div class="col-md-8">
									<input class="form-control" name="witness" id="witness" placeholder="Name of Witness" required	data-fv-notempty-message="The witness name is required">
								  </div>
							  </div>
							  <div class="form-group">
								<label for="witness_reg_no" class="col-md-4 control-label">Registration No.</label>
								  <div class="col-md-8">
								  <input class="form-control" name="witness_reg_no" id="witness_reg_no" placeholder="Witness Registration No." required	data-fv-notempty-message="The witness registration no is required">
								</div>
							  </div>
							</div>
						</div>
						  <div class="col-md-12">			
							  <div class="form-group">
							  	<div class="col-md-offset-2 col-md-4">
								  <button type="reset" class="btn-lg btn-primary" onclick="$('#newMemberForm').data('formValidation').resetForm();"><span class="glyphicon glyphicon-repeat"></span> Clear Form</button>
								</div>
								<div class="col-md-4">
								  <button type="submit" name="newMember" class="btn-lg btn-success"><span class="glyphicon glyphicon-floppy-open"></span> Add Member</button>
								</div>
							  </div>
							</div>
				</div>
			</div>
		</div>
	 <script>
	$(function() {
	$( "#dob" ).datepicker({ dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+15"
		});
	});
	$(function() {
	$( "#join_date" ).datepicker({ dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		onSelect: function () {
		$('#newMemberForm').formValidation('updateStatus', 'join_date', 'NOT_VALIDATED')
       .formValidation('validateField', 'join_date');}
		 });
	});
	</script>
	<script>
	function get_age()
	{
		var dob = document.getElementById('dob').value;
		if(dob != ''){
		var str=dob.split('-');    
		var firstdate=new Date(str[2],str[1],str[0]);
		var today = new Date();        
		var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
		var age = parseInt(dayDiff);
		document.getElementById("age").value=age;
		$('#newMemberForm').formValidation('updateStatus', 'dob', 'NOT_VALIDATED')
       .formValidation('validateField', 'dob');
       $('#newMemberForm').formValidation('updateStatus', 'age', 'NOT_VALIDATED')
       .formValidation('validateField', 'age');
		}
	}
	</script>
<script>
$(document).ready(function()	{
	$(function(){
		getJoinDate();
	});
    $('#newMemberForm').formValidation({
	    	icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields:{
				mem_no:{
					verbose: false,
					validators:{
						digits:{
							message:'Enter a valid membership no.Should be of the form 123'
						},
						remote: {
	                        url: 'ajax/check_if_member_no_is_available.php',
	                        // Send { username: 'its value', email: 'its value' } to the back-end
	                        /*data: function(validator) {
	                            return {
	                                name{name}:{value} validator.getFieldElements('mem_no').val()
	                            };
	                        },*/
	                        message: 'The membership no is already registered',
	                        type: 'POST',
	                        delay:1000
                    	}
					}
				},
				reg_no:{
					validators:{
						regexp:{
							regexp: /^\d+(\/\d+)?$/,
							message:'Enter a valid registration no.Should be of the form 123 or 123/45'
						}
					}
				},
				dob:{
				 	validators: {
                    	date: {
	                        format: 'DD-MM-YYYY',
	                        message: 'The value is not a valid date.Should be of form DD-MM-YYYY'
                    	}
                	}
              	},
              	join_date:{
				 	validators: {
                    	date: {
	                        format: 'DD-MM-YYYY',
	                        message: 'The value is not a valid date.Should be of form DD-MM-YYYY'
                    	}
                	}
              	},
              	phone: {
                    validators: {
                        phone: {
                            country: 'IN',
                            message: 'The value is not valid %s phone number.Try adding std code to the number'
                        }
                    }
                },
                share:{
					validators:{
						digits:{
							message:'Enter a valid  number of shares'
						}
					}
				},
				age: {
	                validators: {
	                    between: {
	                        min: 0,
	                        max: 120,
	                        message: 'Enter a valid age'
	                    }
	                }
            	},
            	designation:{
					enabled: true,
            	}
			},

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
            var jqxhr =$.post("ajax/member_add_new.php", $form.serialize() , function(result) {
                // ... Process the result ...
                if(result['success']){
                	swal({  title: "Success!",   
                			text: "The member has been sucessfully added",
                			type: "success",   
                			timer: 2000,   
                			allowOutsideClick: true
                			 });
                	$('form#newMemberForm').data('formValidation').resetForm();
  		   			$('form#newMemberForm')[0].reset();
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
        });
	});
	//to populate the join date input to the current date
    function getJoinDate()
    {
		$('#join_date').datepicker('setDate', new Date());
		$('#newMemberForm').formValidation('updateStatus', 'join_date', 'NOT_VALIDATED')
			.formValidation('validateField', 'join_date');
    }
    $("form#newMemberForm").keydown(function(event){//prevent form submit on enter 
	    if( (event.keyCode == 13)  ) {
	      event.preventDefault();
	      return false;
	    }
	});
</script>

<?php include ("footer.php");?>
