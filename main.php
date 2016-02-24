<?php
include('session.php');
?>

<html>
<head><title>CarPooling</title></head>

<body>
<table>
<tr> <td colspan="2" style="background-color:#FFA500;">
<h1> CarPooling html test</h1>
</td></tr>
<tr><td>
<b>Welcome: <i><?php echo $login_session; ?></i></b>
<b><a href="logout.php">Logout</a></b>
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