<?php
include('session.php');
?>

<html>
<head><title> Set Profile </title> </html>
<body>
	<div> <!-- Changing Passwords -->
		<p><b>Change new password</b></p>
		<form action="set_password.php" method="post">
			<label>New password:</label>
			<input type="password" name="newPassword" placeholder="************" type="password">
			<label>Old password:</label>
			<input type="password" name="oldPassword" placeholder="************" type="password">
			<input name="submit" type="submit">
		</form>
	</div>
	<div> <!-- Changing Email -->
		<p><b>Set email</b></p>
		<form action="set_email.php" method="post">
			<label>New Email:</label>
			<input type="text" name="newEmail">
			<input name="submit" type="submit">
		</form>
	</div>
	<div> <!-- Car Display, should be in table format -->
		<?php
			$username = $login_session;
			$query = "SELECT * FROM owns_car WHERE cOwner = '$username'";
			$result = pg_query($query);
			
			print "<p> \n <table> \n <tr> \n <b>Your Cars</b> \n </tr> \n <tr> \n <td>License</td> \n <td>Seat Available</td></tr> \n ";
			while ($row = pg_fetch_array($result)) {
				print "<tr><td> \n";
				print $row[0];
				print "</td> \n <td> \n";
				print (string) $row[1];
				print "</td></tr> \n";
			}
			print "</table> \n </p> \n";

		?>
	</div>
	<div> <!-- Cars setting, for adding new cars -->
		<p><b>Register cars</b></p>
		<form action="register_car.php" method="post">
			<label>New Car License Number:</label>
			<input type="text" name="newLicense">
			<label>Seats Available:</label>
			<input type="number" name="seatsAvailable" min="1">
			<input name="submit" type="submit">
		</form>
	</div>
	<div> <!-- Funds Display, should be in table format -->
		<?php
			$username = $login_session;
			$query = "SELECT money FROM users WHERE name = '$username'";
			$result = pg_query($query);
			
			print "<p> \n <table> \n <tr> \n <b>Current Amount</b> \n </tr> \n <tr> \n ";
			while ($row = pg_fetch_array($result)) {
				print "<tr><td> \n";
				print (string) $row[0];
				print "</td></tr> \n";
			}
			print "</table> \n </p> \n";

		?>
	</div>
	<div> <!-- Add money, for adding new cars -->
		<p><b>Add funds</b></p>
		<form action="add_funds.php" method="post">
			<label>Add amount:</label>
			<input type="number" name="funds" min="1">
			<input name="submit" type="submit">
		</form>
	</div>
	<div>
		<b><a href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
	</div>
</body>
</html>