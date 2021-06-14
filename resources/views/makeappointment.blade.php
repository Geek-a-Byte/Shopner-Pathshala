<?php
include public_path('includes/connection.php');
// $sql = 'BEGIN find_available_doctors(:d_id,:d_name,:d_email,:d_designation); END;';
// $stmt = oci_parse($conn, $sql);
// oci_bind_by_name($stmt, ':d_id', $d_id, 10, 0);
// oci_bind_by_name($stmt, ':d_name', $d_name, 255);
// oci_bind_by_name($stmt, ':d_email', $d_email, 255);
// oci_bind_by_name($stmt, ':d_designation', $d_designation, 255);
// oci_execute($stmt);
// print "$d_id\n$d_name\n$d_email\n$d_designation";
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    
</body>
</html>


<!Doctype html>
<html lang="en">
	<head>
		
	    <style>
	    	.border-top { border-top: 1px solid #e5e5e5; }
			.border-bottom { border-bottom: 1px solid #e5e5e5; }

			.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
	    </style>
	</head>
	<body>
	
	    <div class="container-fluid">
	    	<br />
	    	<br />		      	
            <div class="card">
		      		<form method="post" action="result.php">
			      		<div class="card-header"><h3><b>Doctor Schedule List</b></h3></div>
			      		<div class="card-body">
		      				<div class="table-responsive">
		      					<table class="table table-striped table-bordered">
		      						<tr>
		      							<th>Doctor ID</th>
		      							<th>Doctor Name</th>
		      							<th>Doctor Email ID</th>
		      							<th>Designation</th>
		      							<th>Action</th>
		      						</tr>
                                      <?php
        
        
        $user = DB::select('select * from doctors');
        
    foreach ($user as $row) {
        echo $row->doctor_name . '<br>';
    }

        // echo $user->doctor_id;
        // echo $user->doctor_name;

        ?>                             @foreach ($user as $row)
		      						   <tr>
		      								<td><?php echo $row->doctor_id?></td>
		      								<td><?php echo $row->doctor_name?></td>
		      								<td><?php echo $row->doctor_email_id?></td>
		      								<td><?php echo $row->doctor_designation?></td>
		      								<td><button type="button" name="get_appointment" class="btn btn-primary btn-sm get_appointment" data-id="228">Get Appointment</button></td>
		      							</tr>
                                        @endforeach
		      							
		      						
		      	               </table>
		      				</div>
		      			</div>
		      		</form>
		      	</div>
		    

			
	    </div>
		<script>

$(document).ready(function(){
	$(document).on('click', '.get_appointment', function(){
		var action = 'check_login';
		var doctor_schedule_id = $(this).data('id');
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action, doctor_schedule_id:doctor_schedule_id},
			success:function(data)
			{
				window.location.href=data;
			}
		})
	});
});

</script>

	</body>
</html>
