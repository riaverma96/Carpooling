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
			<p>
			<select name = "car" form="offer_create_form">
			<?php 
				$username = $_SESSION['login_user'];	
				$query = "SELECT license from owns_car WHERE cOwner = '$username'";
				$result = pg_query($query);
				
				if(pg_num_rows($result) == 0){
					print "<option value=\"null\">No cars</option>";
				} else{
					while ($row = pg_fetch_array($result)){
						print "<option value=\"$row[0]\">$row[0]</option>";
					}
				}
			?>
			</select>
			</p>
			
		</div>
		
		
		<div>		
			<form action = "offer_create_script.php" id= "offer_create_form" method="post">
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
				<label>Asking Price:</label>
				<input type="number" name="price" step = "0.01" min="0.00" value = "0.00">
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