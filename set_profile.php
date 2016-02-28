<?php
include('session.php');
?>

<html>
<head><title> Set Profile </title> </html>
<body>
	<div>
		<form action="set_password.php" method="post">
			<label>New password:</label>
			<input type="password" name="newPassword" placeholder="************" type="password">
			<label>Old password:</label>
			<input type="password" name="oldPassword" placeholder="************" type="password">
			<input name="submit" type="submit">
		</form>
	</div>
	<div>
		<b><a href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
	</div>
</body>
</html>