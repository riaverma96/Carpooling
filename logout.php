<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: http://127.0.0.1/login.php"); // Redirecting To Home Page
}
?>