<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['submit'])) {
		if (empty($_POST['car'])){
			$error = "You have not selected a car.";
			echo $error;
		} elseif(empty($_POST['startPoint']) || empty($_POST['endPoint'])){
			$error = "Start or End point invalid!";
			echo $error;
		} elseif($_POST['pax'] <= 0){
			$error = "You haven't selected the number of passengers you are willing to take.";
			echo $error;
		} else {
			$car = $_POST['car'];
			$start = $_POST['startPoint'];
			$end = $_POST['endPoint'];
			$pax = $_POST['pax'];
			$price = $_POST['price'];
			
			$username = $login_session;
			
			$query = "SELECT MAX(offerid) FROM creates_offer";
			$result = pg_query($query);		
			$row = pg_fetch_array($result);
			$offerNum = $row[0] + 1;
			
			echo $car;
			echo "\n";
			echo $start;
			echo "\n";
			echo $end;
			echo "\n";
			echo $pax;
			echo "\n";
			echo $price;
			echo "\n";
			echo $username;
			echo "\n";
			echo $offerNum;
			echo "\n";
			
			$db = include 'postgresconnect.php';

			$query = "INSERT INTO creates_offer (offerid, fromwhere, towhere, tripcost, numseatsremaining, usedcar) VALUES ('$offerNum', '$start', '$end', '$price', '$pax', '$car')";
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

?>