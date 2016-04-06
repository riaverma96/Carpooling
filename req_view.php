<?php
include('session.php');
?>

<html>
	<head>
		<title> Outstanding Requests </title>
	</head>

	<body>
		<div>		
			<p><table border = "1"> 
				<th colspan ="7"><b>Currently Outstanding Requests</b></th>
				<tr><td>RequestID</td><td>From</td><td>To</td><td>Pax</td><td>Date</td><td>Time</td><td>Requestor</td>

				<?php
					$username = $_SESSION['login_user'];
					$date = date("Y-m-d");
					$query = "SELECT * FROM creates_request WHERE rdate >= '$date'";
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
						print str_pad((string) $row[6], 4, STR_PAD_LEFT);
						print "</td><td>";
						print $row[6];
						print "</td></tr>";
					}
				?>
			
			</table></p>
		</div>
		
		<p>
		<a href="http://127.0.0.1/req_create.php">Request a Ride</a>
		</p> <p>
		<a href="http://127.0.0.1/main.php">Back</a>
		</p>

	</body>
</html>