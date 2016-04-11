<?php
$title = 'admin';
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

	<title> View all Offers and Requests </title>
</head>

<body>
	<?php
	include('navbar.php'); 
	if ($admin_session == 'f') {
		error_log("Non-Administrators are prohibited from entry");
		header("Location: http://127.0.0.1/main.php");
	}
	?>

	<div>
		<p><b>Delete an Offer</b></p>

		<form action = "offer_delete_script.php" method = "post">
			<p><table border = "1"> 
				<th colspan ="9"><b>Currently Available Offers</b></th>
				<tr><td>OfferID</td><td>From</td><td>To</td><td>Price</td><td>Seats Left</td><td>Date</td><td>Time</td><td>License Num</td><td>Delete</td></tr>

				<?php
				$username = $_SESSION['login_user'];
				$date = date("Y-m-d");
				$query = "SELECT * FROM creates_offer";
                    $result = pg_query($query);

                    while ($row = pg_fetch_array($result)) {
                    	print "<tr><td>";
                    	print (string) $row[0];
                    	print "</td><td>";
                    	print $row[1];
                    	print "</td><td>";
                    	print $row[2];
                    	print "</td><td>";
                    	print (string) $row[3];
                    	print "</td><td>";
                    	print (string) $row[4];
                    	print "</td><td>";
                    	print (string) $row[5];
                    	print "</td><td>";
                    	print str_pad((string) $row[6], 4, STR_PAD_LEFT);
                    	print "</td><td>";
                    	print $row[7];
                    	print "</td><td>";
                    	print "<input type = \"radio\" name = \"offerNum\" value = \"$row[0]\">";
                    	print "</td></tr>";
                    }
                    ?>

                </table></p>
                <input name="submit" type="submit" value="Delete Offer">
            </form>
        </div>
        <div>
        	<p><b>Delete a Request</b></p>

		<form action = "req_delete_script.php" method = "post">
			<p><table border = "1"> 
				<th colspan ="9"><b>Currently Available Requests</b></th>
				<tr><td>RequestID</td><td>From</td><td>To</td><td>Seats Wanted</td><td>Date</td><td>Time</td><td>Requestor</td><td>Delete</td></tr>

				<?php
				$username = $_SESSION['login_user'];
				$date = date("Y-m-d");
				$query = "SELECT * FROM creates_request"; # Not exists handles case where user already booked the same ride previously.
                	$result = pg_query($query);

                    while ($row = pg_fetch_array($result)) {
                    	print "<tr><td>";
                    	print (string) $row[0];
                    	print "</td><td>";
                    	print $row[1];
                    	print "</td><td>";
                    	print $row[2];
                    	print "</td><td>";
                    	print (string) $row[3];
                    	print "</td><td>";
                    	print (string) $row[4];
                    	print "</td><td>";
                    	print str_pad((string) $row[5], 4, STR_PAD_LEFT);
                    	print "</td><td>";
                    	print $row[6];
                    	print "</td><td>";
                    	print "<input type = \"radio\" name = \"RequestNum\" value = \"$row[0]\">";
                    	print "</td></tr>";
                    }
                    ?>

                </table></p>
                <input name="submit" type="submit" value="Delete Request">
            </form>
        </div>
        <div>
            <p><b>Delete a Booking</b></p>

        <form action = "booking_delete_script.php" method = "post">
            <p><table border = "1"> 
                <th colspan ="9"><b>Currently present Bookings</b></th>
                <tr><td>Booking User</td><td>OfferID</td><td>Delete</td></tr>

                <?php
                $username = $_SESSION['login_user'];
                $date = date("Y-m-d");
                $query = "SELECT * FROM booking"; # Not exists handles case where user already booked the same ride previously.
                    $result = pg_query($query);
                    $index = 1;
                    while ($row = pg_fetch_array($result)) {
                        print "<tr><td>";
                        print $row[1];
                        print "</td><td>";
                        print (string) $row[2];
                        print "</td><td>";
                        print "<input type = \"radio\" name = \"BookingIndex\" value = \"$index\">";
                        print "<input type = \"hidden\" name = \"BookingUser$index\" value = \"$row[1]\">";
                        print "<input type = \"hidden\" name = \"OfferID$index\" value = \"$row[2]\">";
                        print "</td></tr>";
                        $index = $index + 1;
                    }
                    ?>

                </table></p>
                <input name="submit" type="submit" value="Delete Booking">
            </form>
        </div>


        <a href="http://127.0.0.1/main.php">Back</a>

    </body>
    </html>