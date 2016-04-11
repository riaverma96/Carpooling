<?php
$title = 'create';
include('session.php');
?>

<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<title> Request a Ride </title>
	</head>

	<body>
	
	<?php
		include('navbar.php'); 
	?>
		<div>
			<p><b>Request a Ride</b></p>
		
			<p>Be sure to <a href="http://127.0.0.1/offer_accept.php">check</a> that no one has offered a suitable ride before submitting your request.</p>
			
		</div>
		
		<div>		
			<form action = "req_create_script.php" id= "req_create_form" method="post">
				<p>
				<label>Start Point:</label>
				<input type="text" name="startPoint">
				</p> <p>
				<label>End Point:</label>
				<input type="text" name="endPoint">
				</p> <p>
				<label>Number of Passengers:</label>
				<input type="number" name="pax" min="1" value = "1">
				</p> <p>
				<label>Date:</label>
				<input type="date" name="date" value = "<?php echo date('Y-m-d'); ?>">
				</p> <p>
				<label>Time:</label>
				<input type="number" name="hour" size = "2" min = "00" max = "23" value = "00">
				<label>:</label>
				<input type="number" name="minute" min = "00" max = "59" size = "2" value = "00">
				</p><p>
				<input name="submit" type="submit">
				</p>
			</form>
		</div>
		
		<a href="http://127.0.0.1/main.php">Back</a>

	</body>
</html>