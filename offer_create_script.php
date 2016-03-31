<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		
		$date = date('Y-m-d');
		
		if (empty($_POST['car'])){
			$error = "You have not selected a car.";
			echo $error;
		} elseif($_POST['car'] == 'null'){
			$error = "It appears you do not own a car...";
			echo $error;
		} elseif(empty($_POST['startPoint']) || empty($_POST['endPoint'])){
			$error = "Start or End point invalid!";
			echo $error;
		} elseif($_POST['pax'] <= 0){
			$error = "You haven't selected the number of passengers you are willing to take.";
			echo $error;
		} elseif($_POST['date'] < $date){
			$error = "You can't offer a ride in the past.";
			echo $error;
		} else {
			$car = $_POST['car'];
			$start = $_POST['startPoint'];
			$end = $_POST['endPoint'];
			$pax = $_POST['pax'];
			$price = $_POST['price'];
			$date = $_POST['date'];
			$time = $_POST['hour']*100 + $_POST['minute'];
			
			$username = $login_session;
			
			$query = "SELECT MAX(offerid) FROM creates_offer";
			$result = pg_query($query);		
			$row = pg_fetch_array($result);
			$offerNum = $row[0] + 1;
			
			$query = "SELECT numfreeseats FROM owns_car WHERE license = '$car'";
			$result = pg_query($query);		
			$row = pg_fetch_array($result);
			$maxPax = $row[0];
			
			if($maxPax < $pax){
				$error = "Your car cannot carry so many people!";
				echo $error;
			} else{
				$db = include 'postgresconnect.php';

				$query = "INSERT INTO creates_offer (offerid, fromwhere, towhere, tripcost, numseatsremaining, offerdate, offertime, usedcar) VALUES ('$offerNum', '$start', '$end', '$price', '$pax', '$date', '$time', '$car')";
				$result = pg_query($query);
			
				if (!$result) {
					$error = pg_last_error();
					echo $error;
				} else {
					$error = "New offer added successfully.";
					echo $error;
				}
				pg_close($db);
			}	
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
			<a href="http://127.0.0.1/offer_create.php">Create another offer</a>
			</p> <p>
			<a href="http://127.0.0.1/main.php">Back to Home</a>
			</p>
		</div>

	</body>
</html>