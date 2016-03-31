<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		
		$date = date('Y-m-d');
		
		if(empty($_POST['startPoint']) || empty($_POST['endPoint'])){
			$error = "Start or End point invalid!";
			echo $error;
		} elseif($_POST['pax'] <= 0){
			$error = "You must request for more than 0 passengers.";
			echo $error;
		} elseif($_POST['date'] < $date){
			$error = "You can't request a ride from the past.";
			echo $error;
		} else {
			$start = $_POST['startPoint'];
			$end = $_POST['endPoint'];
			$pax = $_POST['pax'];
			$date = $_POST['date'];
			$time = $_POST['hour']*100 + $_POST['minute'];
			
			$username = $login_session;
			
			$query = "SELECT MAX(rid) FROM creates_request";
			$result = pg_query($query);		
			$row = pg_fetch_array($result);
			$reqNum = $row[0] + 1;

			$db = include 'postgresconnect.php';

			$query = "INSERT INTO creates_request (rid, fromwhere, towhere, numseatswanted, rdate, rtime, requestor) VALUES ('$reqNum', '$start', '$end', '$pax', '$date', '$time', '$username')";
			$result = pg_query($query);
			
			if (!$result) {
				$error = pg_last_error();
				echo $error;
			} else {
				$error = "New request added successfully.";
				echo $error;
			}
			pg_close($db);	
		}
	}

?>

<html>
	<head>
		<title> Creation Result </title>
	</head>

	<body>
		<div>
			<p>
			<a href="http://127.0.0.1/req_create.php">Create another request</a>
			</p> <p>
			<a href="http://127.0.0.1/main.php">Back to Home</a>
			</p>
		</div>

	</body>
</html>