<?php 
include ('session.php');
?>

<?php
	$error = '';
	if (isset($_POST['money'])) {
		if (empty($_POST['money'])) {
			error_log("Cannot leave money blank");
		}
		else {
			$newmoney = $_POST['money'];
			$searchUser = $_POST['search'];
			$query = "UPDATE users SET money = '$newmoney' WHERE name ='$searchUser'";
			$result = pg_query($query);
			
			if (!$result) {
				error_log( pg_last_error());
			}	
		}
	}
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
	<title> Updated Money </title>
	</head>
	<body>
		<div class="container">
			<h1>Successfully updated amount!</h1>
			
			<div style = "padding-bottom:10px;">
				<b><a class = "btn btn-primary" href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
			</div>
		</div>
	</body>
</html>