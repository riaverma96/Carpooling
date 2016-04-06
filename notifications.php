<?php
include('session.php');
include('navbar.php');
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
<h2>New bookings since your last login:</h2>

	<div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-md-2">OfferID</th>
                  <th class="col-md-2">Date/Time</th>
                  <th class="col-md-2">From</th>
				  <th class="col-md-2">To</th>
				  <th class="col-md-2">Car</th>
				  <th class="col-md-2">Passenger's Name</th>
				  <th class="col-md-2">Passenger's Email</th>
                </tr>
              </thead>
              <tbody>
				<?php
					$username = $login_session;
					$query = "SELECT o.offerid, o.offerdate, o.offertime, o.fromwhere, o.towhere, o.usedcar, u2.name, u2.email FROM creates_offer o, booking b, users u1, users u2 WHERE b.isusernotified = false AND b.offerid = o.offerid AND b.username = u2.name AND o.usedcar IN(SELECT c.license FROM owns_car c WHERE c.cowner = u1.name AND u1.name = '$username')"; 
					$result = pg_query($query);
					
					while($row = pg_fetch_array($result)){
						$id = $row[0];
						$date = (string) $row[1];
						$time = str_pad((string) $row[6], 4, "0", STR_PAD_LEFT);
						$from = $row[3];
						$to = $row[4];
						$car = (string) $row[5];
						$passenger = $row[6];
						$email = $row[7];
						
						print "<tr><td class=\"col-md-2\">";
						print "$id";
						print "</td><td class=\"col-md-2\">";
						print "$date $time";
						print "</td><td class=\"col-md-2\">";
						print "$from";
						print "</td><td class=\"col-md-2\">";
						print "$to";
						print "</td><td class=\"col-md-2\">";
						print "$car";
						print "</td><td class=\"col-md-2\">";
						print "$passenger";
						print "</td><td class=\"col-md-2\">";
						print "$email";
						print "</td></tr>";
						
					}
				?>
              </tbody>
            </table>
          </div>
</body>
</html>