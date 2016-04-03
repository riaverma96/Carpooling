<?php
include('session.php');
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
<title> Set Profile </title>
<body>
<?php
$query = "SELECT COUNT(*)
			FROM booking b
			WHERE b.username = '$login_session'
			AND b.isUserNotified = 'false'";
$numNotifications = pg_query($query); 
?>
<div class="container">
    <ul class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://127.0.0.1/main.php">CarPooling</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
				<li><a href="http://127.0.0.1/main.php">Home</a></li>
				<li><a href="http://127.0.0.1/offer_create.php">Offer Ride</a></li>
                <li><a href="http://127.0.0.1/offer_accept.php">Book a Ride</a></li>
				<li><a href="http://127.0.0.1/req_create.php">Request Ride</a></li>
				<li><a href="http://127.0.0.1/search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
				<li><a href="http://127.0.0.1/search_users.php"><span class="glyphicon glyphicon-search"></span> Search Users</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" style="cursor:pointer;">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-user"></span> 
						<?php echo $login_session; ?> 
						<span class="badge">
						<?php if (is_null($numNotifications[0])) {
								print '0';
							} else {
								print $numNotifications[0];
							} ?> </span>
					<ul class="dropdown-menu">
						<li><a href="http://127.0.0.1/set_profile.php">Set Profile</a></li>
						<li><a href="http://127.0.0.1/notifications.php">Notifications</a></li>
					</ul>
				</li>
				<li>
					<a href="http://127.0.0.1/logout.php">
					<span class="glyphicon glyphicon-log-out"></span> Logout
					</a>
				</li>
            </ul>
        </div>
    </div>
	</ul>
</div>
<!-- Offset Navbar -->
<div style = "margin-top:70px;"></div>

	<div class="container">
		<div class = "jumbotron">
			<h1><b><?php print "$login_session"?>'s Profile</b></h1>			
		</div>
	</div>

	<div class = "container"> <!-- Car Display, should be in table format -->
	<div class = "col-xs-6">
		<h2 class="sub-header">Your Cars</h2>
		<div class="table-responsive">
		<?php
			$username = $login_session;
			$query = "SELECT * FROM owns_car WHERE cOwner = '$username'";
			$result = pg_query($query);
			
			print "<table class=\"table table-striped\"> \n 
			 <thead><tr> \n
			 <th class=\"col-md-2\">License</th> \n 
			 <th class=\"col-md-2\">Seats Available</th> \n 
			 </tr></thead>\n ";
			print "<tbody>\n";
			while ($row = pg_fetch_array($result)) {
				print "<tr><td class=\"col-md-2\"> \n";
				print $row[0];
				print "</td><td class=\"col-md-2\"> \n";
				print (string) $row[1];
				print "</td></tr> \n";
			}
			print "</tbody></table> \n";

		?>
	</div>
	</div>
		<div class = "col-xs-6">
		<h2 class="sub-header">Your Funds</h2>
		<div class="table-responsive">
		<?php
			$username = $login_session;
			$query = "SELECT money FROM users WHERE name = '$username'";
			$result = pg_query($query);
			
			print "<table class=\"table table-striped\"> \n 
			 <thead><tr> \n
			 <th class=\"col-md-2\">Current Amount</th> \n 
			 </tr></thead>\n ";
			 print "<tbody>\n";
			while ($row = pg_fetch_array($result)) {
				print "<tr><td class=\"col-md-2\"> \n";
				print (string) $row[0];
				print "</td></tr> \n";
			}
			print "</tbody></table> \n";
		?>
	</div>
	</div>
	</div>

	<div class="container">
	<div class="col-xs-6"> <!-- Cars setting, for adding new cars -->
		<h2 class="sub-header">Register Car</h2>
		<div>
		<form class="form-horizontal" action="register_car.php" method="post">
		<div class="form-group">
			<label class = "col-sm-2 control-label" style="width:150px">License Number:</label>
			<input class="form-control" style="width:200px" type="text" name="newLicense">
		</div>
		<div class="form-group">
			<label class = "col-sm-2 control-label" style="width:150px">Seats Available:</label>
			<input class="form-control" style="width:200px"  type="number" name="seatsAvailable" min="1">
		</div>
		<div class="col-sm-offset-1 col-sm-6" style = "margin-bottom: 20px">
			<input class="btn btn-primary" style="width:100px" name="submit" type="submit" value="Register">
		</div>
		</form>
	</div>
	</div>

	<div class="col-xs-6"> <!-- Add money, for adding new cars -->
		<h2 class="sub-header">Add Funds</h2>
		<div>
		<form class="form-horizontal" action="add_funds.php" method="post">
		<div class="form-group">
			<label class = "col-sm-4 control-label">Add amount:</label>
			<input class="form-control" style="width:200px" type="number" name="funds" step = "0.10" value = "1.00" min="1.00">
		</div>
		<div class="col-sm-offset-1 col-sm-6" style = "margin-bottom: 20px">
			<input class="btn btn-primary" style="width:100px" name="submit" type="submit" value="Add">
		</div>
		</form>
	</div>
	</div>
	</div>

	<div class = "container"> <!-- Changing Passwords -->
	<div class = "col-xs-12">
		<h2 class="sub-header">Change new password</h2>
		<div>
		<form class="form-horizontal" action="set_password.php" method="post">
			<div class="form-group">
				<label class = "col-sm-2 control-label">New password:</label>
				<input class="form-control" style="width:600px" type="password" name="newPassword" placeholder="************">
			</div>
			<div class="form-group">
				<label class = "col-sm-2 control-label">Old password:</label>
				<input class="form-control" style="width:600px" type="password" name="oldPassword" placeholder="************">
			</div>
			<div class="col-sm-offset-1 col-sm-6" style = "margin-bottom: 20px">
				<input class="btn btn-primary" style="width:200px" name="submit" type="submit" value="Change password">
			</div>
		</form>
	</div>
	</div>
	</div>

	<div class = "container"> <!-- Changing Email -->
	<div class = "col-xs-12">
		<h2 class="sub-header">Set Email</h2>
		<div> 
		<form class="form-horizontal" action="set_email.php" method="post">
			<div class="form-group">
				<label class = "col-sm-2 control-label">New Email:</label>
				<input class="form-control" style="width:600px" type="text" name="newEmail">
			</div>
			<div class="col-sm-offset-1 col-sm-6" style = "margin-bottom: 20px">
				<input class="btn btn-primary" style="width:150px" name="submit" type="submit" value="Change Email">
			</div>
		</form>
	</div>
	</div>
	</div>

	<div>
		<b><a href="http://127.0.0.1/main.php">Go back to Main Page</a></b>
	</div>
</body>
</html>