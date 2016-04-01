<html>
<head> <title> Search </title> </head>

<body>
<table>
<tr> <td colspan="2" style="background-color:#FFA500;">
<h1> Find a Ride! </h1>
</td> </tr>
<?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=hour12")
        or die('Could not connect: ' . pg_last_error()); 
?>
<tr>
<td style="background-color:#eeeeee;">

<form>
Ride Date: <input type="date" name="day"> 

<select name= "start"> <option value=""> Start </option>
    <?php
    $query = 'SELECT DISTINCT start FROM rides';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
     
    while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
       foreach ($line as $col_value) {
          echo "<option value=\"".$col_value."\">".$col_value."</option><br>";
        }
    }
    pg_free_result($result);
    ?>
</select>

<select name= "start"> <option value=""> Start </option>
    <?php
    $query = 'SELECT DISTINCT start FROM rides';
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
     
    while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
       foreach ($line as $col_value) {
          echo "<option value=\"".$col_value."\">".$col_value."</option><br>";
        }
    }
    pg_free_result($result);
    ?>
</select>

<select name= "destination"> <option value=""> Destination </option>
    <?php
    $queryo = 'SELECT DISTINCT destination FROM rides';
    $resulto = pg_query($queryo) or die('Query failed: ' . pg_last_error());
     
    while($lineo = pg_fetch_array($resulto, null, PGSQL_ASSOC)){
       foreach ($lineo as $col_valueo) {
          echo "<option value=\"".$col_valueo."\">".$col_valueo."</option><br>";
        }
    }
    pg_free_result($resulto);
    ?>
</select>

<select name= "car"> <option value=""> Select a Car </option>
    <?php
    $queryk = 'SELECT DISTINCT car FROM rides';
    $resultk = pg_query($queryk) or die('Query failed: ' . pg_last_error());
     
    while($linek = pg_fetch_array($resultk, null, PGSQL_ASSOC)){
        foreach ($linek as $col_valuek) {
          echo "<option value=\"".$col_valuek."\">".$col_valuek."</option><br>";
        }
    }
    pg_free_result($resultk);
    ?>
</select>

<input type="submit" name="formSubmit" value="Search" >
</form>

<?php
if(isset($_GET['formSubmit'])) {

    $cI = $_GET['car'];
    $sI = $_GET['start'];
    $eI = $_GET['destination'];
    $dI = $_GET['day'];

    $query = "SELECT * FROM rides"; 

    // None Of The Fields Are Empty (1)
    if ($cI != "" && $sI != "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND start='".$_GET['start']."' AND destination='".$_GET['destination']."' AND day = '".$_GET['day']."' ";
    }

    // Only One Field Is Empty (4)
    if ($cI == "" && $sI != "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE start='".$_GET['start']."' AND destination='".$_GET['destination']."' AND day = '".$_GET['day']."' ";
    } else if ($cI != "" && $sI == "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND destination='".$_GET['destination']."' AND day = '".$_GET['day']."' ";
    } else if ($cI != "" && $sI != "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND start='".$_GET['start']."' AND day = '".$_GET['day']."' ";
    } else if ($cI != "" && $sI != "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND start='".$_GET['start']."' AND destination='".$_GET['destination']."' ";
    } 

    // Two Fields Are Empty (6)
    if ($cI == "" && $sI == "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE destination='".$_GET['destination']."' AND day = '".$_GET['day']."' ";
    } else if ($cI == "" && $sI != "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE start='".$_GET['start']."' AND day = '".$_GET['day']."' ";
    } else if ($cI == "" && $sI != "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM rides WHERE start='".$_GET['start']."' AND destination='".$_GET['destination']."' ";
    } 

    if ($cI != "" && $sI == "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND day = '".$_GET['day']."' ";
    } else if ($cI != "" && $sI == "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND destination='".$_GET['destination']."' ";
    }

    if ($cI != "" && $sI != "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' AND start='".$_GET['start']."' ";
    } 

    // Three Fields Are Empty (4)
    if ($cI == "" && $sI == "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM rides WHERE day = '".$_GET['day']."' ";
    } else if ($cI == "" && $sI == "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM rides WHERE destination='".$_GET['destination']."' ";
    } else if ($cI == "" && $sI != "" && $eI == "" && $dI == "") {
      echo "only start location picked";
      $query = "SELECT * FROM rides WHERE start='".$_GET['start']."' ";
    } else if ($cI != "" && $sI == "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM rides WHERE car = '".$_GET['car']."' ";
    } 

    // All Four Fields Are Empty (1)
    if ($cI == "" && $sI == "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM rides";
    }

    echo "<b>SQL:   </b>".$query."<br><br>";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    echo "<table border=\"1\" >
    <col width=\"25%\">
    <col width=\"50%\">
    <col width=\"75%\">
    <col width=\"25%\">
    <col width=\"75%\">
    <col width=\"25%\">
    <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Start Location</th>
    <th>Destination</th>
    <th>Car</th>
    <th>Driver</th>
    </tr>";


    while ($row = pg_fetch_row($result)){
      echo "<tr>";
      echo "<td>" . $row[0] . "</td>";
      echo "<td>" . $row[1] . "</td>";
      echo "<td>" . $row[2] . "</td>";
      echo "<td>" . $row[3] . "</td>";
      echo "<td>" . $row[4] . "</td>"; 
      echo "<td>" . $row[5] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    
    pg_free_result($result);
}
?>


</td> </tr>
<?php
pg_close($dbconn);
?>
<tr>
<td colspan="2" style="background-color:#FFA500; text-align:center;"> Copyright &#169; CS2102
</td> </tr>
</table>

</body>
</html>



<!  WHERE Start='".$_GET['Start']."' AND End='".$_GET['End']."' AND Time= '".$_GET['Time']"'>
<! For Date & Time : datetime-local>