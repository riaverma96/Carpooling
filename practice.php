<?php 
include ('session.php');
?>

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
  <select name="type"> <option value=""> Pick Ride Type: </option>
      <option value="offer">offers</option>
      <option value="request">request</option>

      <?php
        $i=0;
        $array=array("offers", "request");
        while ($i<2) { ?>
          <option value="<?php echo $array[$i];?>"<?php if ((empty($messages) == false) && 
          ($_POST['type'] == $array[$i])) {echo 'selected="selected"';} ?>><?php echo 
          $array[$i];?></option>
          <?php $i++; } ?>

  </select>
  
  <input type="submit" name="formSelect" value="Select">

  Ride Date: <input type="date" name="day"> 

  <select name= "start"> <option value=""> Start </option>
    <?php
      setType2();
      $query = "SELECT DISTINCT fromwhere FROM ".$getType." ";
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
      setType2();
      $queryo = "SELECT DISTINCT towhere FROM ".$getType." ";
      $resulto = pg_query($queryo) or die('Query failed: ' . pg_last_error());
       
      while($lineo = pg_fetch_array($resulto, null, PGSQL_ASSOC)){
        foreach ($lineo as $col_valueo) {
          echo "<option value=\"".$col_valueo."\">".$col_valueo."</option><br>";
        }
      }
      pg_free_result($resulto);
    ?>
  </select>

  <select name= "car"> <option value=""> Seat Availability </option>
    <?php
      setType2();
      if ($getType == "creates_offer") {
        $queryk = "SELECT DISTINCT numseatsremaining FROM ".$getType." ";
      } else {
        $queryk = "SELECT DISTINCT numseatswanted FROM ".$getType." ";  
      }
      $resultk = pg_query($queryk) or die('Query failed: ' . pg_last_error());
       
      while($linek = pg_fetch_array($resultk, null, PGSQL_ASSOC)){
        foreach ($linek as $col_valuek) {
          echo "<option value=\"".$col_valuek."\">".$col_valuek."</option><br>";
        }
      }
      pg_free_result($resultk);
    ?>
  </select>

  <input type="submit" name="formSubmit" value="Search For My Ride!" >
</form>

<form>
 <script type="text/javascript">
    document.getElementById('type').value = "<?php echo $_GET['type'];?>";
</script>
</form>

<?php
if(isset($_GET['formSelect'])) {
  $currType = &$_GET['type'];
}
?>

<?php 
function setType2() {

  global $getType;
  $getType = "creates_offer";
  echo "Actually $_GET was : ".$_GET['type']." ";
  if ($_GET['type'] == "offer") {
    $getType = "creates_offer";
  } else if ($_GET['type'] == "request") {
    $getType = "creates_request";
  } else {
    echo "I'm in the else case";
    $getType = "creates_request";
  }     
}
?>

<?php
if(isset($_GET['formSubmit'])) {
    setType2();
    $qseats = "numseatsremaining";
    if ($getType == "creates_offer") {
      $qseat = "numseatsremaining";
    } else {
      $qseat = "numseatswanted";  
    }    

    $cI = $_GET['car'];
    $sI = $_GET['start'];
    $eI = $_GET['destination'];
    $dI = $_GET['day'];

    $query = "SELECT * FROM ".$getType." "; 

    // None Of The Fields Are Empty (1)
    if ($cI != "" && $sI != "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND fromwhere='".$_GET['start']."' AND towhere='".$_GET['destination']."' AND rdate= '".$_GET['day']."' ";
    }

    // Only One Field Is Empty (4)
    if ($cI == "" && $sI != "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE fromwhere='".$_GET['start']."' AND towhere='".$_GET['destination']."' AND rdate= '".$_GET['day']."' ";
    } else if ($cI != "" && $sI == "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND towhere='".$_GET['destination']."' AND rdate= '".$_GET['day']."' ";
    } else if ($cI != "" && $sI != "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND fromwhere='".$_GET['start']."' AND rdate= '".$_GET['day']."' ";
    } else if ($cI != "" && $sI != "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND fromwhere='".$_GET['start']."' AND towhere='".$_GET['destination']."' ";
    } 

    // Two Fields Are Empty (6)
    if ($cI == "" && $sI == "" && $eI != "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE towhere='".$_GET['destination']."' AND rdate= '".$_GET['day']."' ";
    } else if ($cI == "" && $sI != "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE fromwhere='".$_GET['start']."' AND rdate= '".$_GET['day']."' ";
    } else if ($cI == "" && $sI != "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE fromwhere='".$_GET['start']."' AND towhere='".$_GET['destination']."' ";
    } 

    if ($cI != "" && $sI == "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND rdate= '".$_GET['day']."' ";
    } else if ($cI != "" && $sI == "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND towhere='".$_GET['destination']."' ";
    }

    if ($cI != "" && $sI != "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' AND fromwhere='".$_GET['start']."' ";
    } 

    // Three Fields Are Empty (4)
    if ($cI == "" && $sI == "" && $eI == "" && $dI != "") {
      $query = "SELECT * FROM ".$getType." WHERE rdate= '".$_GET['day']."' ";
    } else if ($cI == "" && $sI == "" && $eI != "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE towhere='".$_GET['destination']."' ";
    } else if ($cI == "" && $sI != "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE fromwhere='".$_GET['start']."' ";
    } else if ($cI != "" && $sI == "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM ".$getType." WHERE ".$qseat." = '".$_GET['car']."' ";
    } 

    // All Four Fields Are Empty (1)
    if ($cI == "" && $sI == "" && $eI == "" && $dI == "") {
      $query = "SELECT * FROM ".$getType."";
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
