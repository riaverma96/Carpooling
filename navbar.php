<?php
$username = $login_session;
$query = "SELECT COUNT(*)
FROM creates_offer o, booking b, users u1, users u2 
WHERE b.isusernotified = 'f'
AND b.offerid = o.offerid 
AND b.username = u2.name AND o.usedcar IN(SELECT c.license FROM owns_car c WHERE c.cowner = u1.name AND u1.name = '$username')";
$numNotifications = pg_fetch_array(pg_query($query)); 
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
				<li <?php if($title === 'main'){ echo "class=\"active\"";}?>><a href="http://127.0.0.1/main.php">Home</a></li>
				<li <?php if($title === 'offer'){ echo "class=\"active\"";}?>><a href="http://127.0.0.1/offer_create.php">Offer Ride</a></li>
				<li <?php if($title === 'accept'){ echo "class=\"active\"";}?>><a href="http://127.0.0.1/offer_accept.php">Book a Ride</a></li>
				<li <?php if($title === 'create'){ echo "class=\"active\"";}?>><a href="http://127.0.0.1/req_create.php">Request Ride</a></li>
				<li <?php if($title === 'search'){ echo "class=\"active\"";}?>><a href="http://127.0.0.1/search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
				<li <?php if($title === 'searchUser'){ echo "class=\"active\"";}?>><a href="http://127.0.0.1/search_users.php"><span class="glyphicon glyphicon-search"></span> Search Users</a></li>
				

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($admin_session == 't') {
                echo "<li ";
                if($title === 'admin') {
					echo "class=\"active\"";
				}
				
				echo "><a href=\"http://127.0.0.1/view_all_offers_requests.php\"><span class=\"glyphicon glyphicon-tasks\"></span> Admin Page</a></li>";
				}
				?>
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