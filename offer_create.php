<?php
include('session.php');
?>

<html>
	<head>
		<title> Create an Offer </title>
	</head>

	<body>
		<div>
			<p><b>Create a new Offer</b></p>
			
			<p><b>Select a car:</b></p>
			<!-- Offer creation form -->
			<select name = "car" form="offer_create_form">
			<?php 
				$username = $_SESSION['login_user'];	
				$query = "SELECT license from owns_car WHERE cOwner = '$username'";
				$result = pg_query($query);
				
				while ($row = pg_fetch_array($result)){
					print "<option value=\"$row[0]\">$row[0]</option>";
				}
			?>
			</select>
			
		</div>
		
		
		<div>		
			<form action = "offer_create_script.php" id= "offer_create_form" method="post">
				<label>Start Point:</label>
				<input type="text" name="startPoint">
				<label>End Point:</label>
				<input type="text" name="endPoint">
				<label>Number of Passengers:</label>
				<input type="number" name="pax" min="0">
				<label>Asking Price:</label>
				<input type="number" name="price" min="0">
				<input name="submit" type="submit">
			</form>
		</div>
		
		<a href="http://127.0.0.1/main.php">Back</a>

	</body>
</html>