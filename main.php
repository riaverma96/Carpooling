<?php
include('session.php');
?>

<html>
<head><title>CarPooling</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>


<body>
<?php
$username = $login_session;
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
				<li class="active"><a href="#">Home</a></li>
				<li><a href="http://127.0.0.1/offer_create.php">Offer Ride</a></li>
        <li><a href="http://127.0.0.1/offer_accept.php">Book a Ride</a></li>
				<li><a href="http://127.0.0.1/req_create.php">Request Ride</a></li>
				<li><a href="http://127.0.0.1/search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="http://127.0.0.1/search_users.php"><span class="glyphicon glyphicon-search"></span> Search Users</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
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
	<div class="jumbotron">
		<h1> CarPooling ROCKS</h1>
		<b>Welcome, <i><?php echo $login_session; ?></i></b>
		<br>
		<?php
			$username = $login_session;
			$query = "SELECT money FROM users WHERE name = '$username'";
			$result = pg_query($query);
			
			print "Current Amount: ";
			while ($row = pg_fetch_array($result)) {
			print (string) $row[0];
			}
		?>
	</div>
</div>
<div class = "container">
<div class="col-xs-6">
<h2 class="sub-header">Your Offers</h2>
  <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-md-2">Date</th>
                  <th class="col-md-2">From</th>
                  <th class="col-md-2">To</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-md-2">Somebody</td>
                  <td class="col-md-2">SQL</td>
                  <td class="col-md-2">this</td>
                </tr>
                <tr>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-2">1,001</td>
                </tr>
                 <tr>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-2">1,001</td>
                </tr>
              </tbody>
            </table>
          </div>
</div>
  <div class="col-xs-6">
          <h2 class="sub-header">Your Requests</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-md-2">Date</th>
                  <th class="col-md-2">From</th>
                  <th class="col-md-2">To</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-md-2">thing.</td>
                  <td class="col-md-2">Thanks,</td>
                  <td class="col-md-2">Ryan</td>
                </tr>
                <tr>
                  <td class="col-md-1">1,001</td>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-3">1,001</td>
                </tr>
                 <tr>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-2">1,001</td>
                  <td class="col-md-2">1,001</td>
                </tr>
              </tbody>
            </table></div>

</div>
</div>
</body>
</html>