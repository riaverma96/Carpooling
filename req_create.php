<?php
include('session.php');
?>

<html>
	<head>
		<title> Request a Ride </title>
	</head>

	<body>
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