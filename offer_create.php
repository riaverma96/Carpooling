<?php
$title = 'offer';
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

		<title> Create an Offer </title>
	</head>

	<body>
<?php
include('navbar.php'); 
?>
	<div class="container">
		<div>
			<h1 class = "jumbotron"><b>Create a new Offer</b></h1>			
			
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-2 control-label">Select a car:</label>
						<select class="form-control" style="width:200px;" name = "car" form="offer_create_form">
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
				</div>
			</form>
		</div>
		
		<div>		
			<form class="form-horizontal" action = "offer_create_script.php" id= "offer_create_form" method="post">
				<div class="form-group">
					<label class = "col-sm-2 control-label">Start Point:</label>
					<input class="form-control" style="width:600px;" type="text" name="startPoint">
				</div> 
				<div class="form-group">
					<label class = "col-sm-2 control-label">End Point:</label>
					<input class="form-control" style="width:600px;" type="text" name="endPoint">
				</div>
				<div class="form-group">
					<label class = "col-sm-2 control-label">Number of Passengers:</label>
					<input class="form-control" style="width:100px;display:inline;" type="number" name="pax" min="1" value = "1">
				</div> 
				<div class="form-group">
					<label class = "col-sm-2 control-label">Asking Price:</label>
					<input class="form-control" style="width:100px;display:inline;" type="number" name="price" step = "0.01" min="0.00" value = "0.00">
				</div>
				<div class="form-group">
					<label class = "col-sm-2 control-label">Date:</label>
					<input class="form-control" style="width:200px;display:inline;" type="date" name="date" value = "<?php echo date('Y-m-d'); ?>">
				</div>
				<div class="form-group">
					<label class = "col-sm-2 control-label">Time:</label>
					<input class="form-control" style="width:100px;display:inline;" type="number" name="hour" size = "2" min = "00" max = "23" value = "00">
					<label>:</label>
					<input class="form-control" style="width:100px;display:inline;" type="number" name="minute" min = "00" max = "59" size = "2" value = "00">
				</div>
				<div class="col-sm-offset-1 col-sm-4" style = "margin-bottom:20px;">
					<input class="btn btn-primary" style="width:100px;" name="submit" type="submit">
					<input class="btn btn-danger" style="width:100px;" value="Back" onclick="window.location='http://127.0.0.1/main.php';"> 
				</div>
			</form>
		</div>
	</div>
	</body>
</html>