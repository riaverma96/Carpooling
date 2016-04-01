<?php
include('session.php');
?>

<html>
<head><title>CarPooling</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
    <ul class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://127.0.0.1/bootstrap.php">CarPooling</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="http://127.0.0.1/offer_create.php">Offer A Ride</a></li>
				<li><a href="http://127.0.0.1/req_create.php">Request a Ride</a></li>
				<li><a href="http://127.0.0.1/req_view.php">Outstanding Requests</a></li>
				<li><a href="http://127.0.0.1/set_profile.php">Change profile settings</a></li>
				<li><a href="http://127.0.0.1/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
	</ul>
</div>

<div class="jumbotron">
	<h1> CarPooling ROCKS</h1>
	<p> Safety Message of the Day: Don't drink and drive.</p>
</div>

<b>Welcome: <i><?php echo $login_session; ?></i></b>

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




</td></tr>
<tr>
<td style="background-color:#eeeeee;">
</td></tr>
<tr>
<td colspan="2" style="background-color:#FFA500; text-align:center;">Copyright something
</td></tr>

</table>
</body>
</html>