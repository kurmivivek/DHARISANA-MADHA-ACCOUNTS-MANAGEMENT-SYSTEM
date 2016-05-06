	</div>
</div>
<?php
if(isset($_GET['c'])) {
	$collapse=$_GET['c'];
	switch($collapse)
	{
		case 1: echo "<script>$('#collapseOne').collapse('show');</script>";
				break;
		case 2: echo "<script>$('#collapseTwo').collapse('show');</script>";
				break;
		case 3: echo "<script>$('#collapseThree').collapse('show');</script>";
				break;
		case 4: echo "<script>$('#collapseFour').collapse('show');</script>";
				break;
		case 5: echo "<script>$('#collapseFive').collapse('show');</script>";
				break;
		case 6: echo "<script>$('#collapseSix').collapse('show');</script>";
				break;
		case 7: echo "<script>$('#collapseSeven').collapse('show');</script>";
				break;
	}
}
?>
<script>
$(document).keydown(function(e) {
    var nodeName = e.target.nodeName.toLowerCase();

    if (e.which === 8) {
        if ( nodeName === 'input'  || nodeName === 'textarea') {
            // do nothing
        } else {
            e.preventDefault();
        }
    }
});
</script>
<?php if(isset($_GET['dSuccess'])){?>
<script>
<?php if($_GET['dSuccess']==1){?>
$( window ).load(function() {
    swal({  title: "Success!",   
	text: "The record has been sucessfully deleted",
	type: "success",   
	timer: 2000,   
	allowOutsideClick: true
	 });
});
<?php } 
else{?>
$( window ).load(function() {
    swal({  title: "Error!",   
		text: "The record couldn't be deleted.Please try again",
		type: "error",     
		allowOutsideClick: true
		 });
});
<?php }?>
</script>
<?php }?>
</body>
</html>
