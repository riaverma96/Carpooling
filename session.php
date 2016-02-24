<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=cs2102");
session_start();// Starting Session
// Storing Session
if (!isset($_SESSION['login_user'])) {
	pg_close($db); // Closing Connection
	error_log("There is no login_user go to login.php");
	header('Location:http://127.0.0.1/login.php'); // Redirecting To Home Page
	die();
}

$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses = pg_query("SELECT name FROM users WHERE name='$user_check'");
$row = pg_fetch_assoc($ses);
$login_session =$row['name'];
if(!isset($login_session)){
	error_log("You only come here if your username is not within the session");
	pg_close($db); // Closing Connection
	header('Location:http://127.0.0.1/login.php'); // Redirecting To Home Page
	die();
} 
?>