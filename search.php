<?php 
include ('session.php');
?>

<html>
  <head> 
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <title> Search-</title>
  </head>

  <body>

    

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
            <li><a href="http://127.0.0.1/main.php">Home</a></li>
            <li><a href="http://127.0.0.1/offer_create.php">Offer Ride</a></li>
                    <li><a href="http://127.0.0.1/offer_accept.php">Book a Ride</a></li>
            <li><a href="http://127.0.0.1/req_create.php">Request Ride</a></li>
            <li class="active"><a href="http://127.0.0.1/search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                    <li><a href="http://127.0.0.1/search_users.php"><span class="glyphicon glyphicon-search"></span> Search Users</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
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

    <div class="container">
      <div style = "margin-top:70px;">
      </div>

      <div>
        <h1 class = "jumbotron"><b> Find a Ride </b></h1>
        
        <form class="form-horizontal">
          <div class="form-group">

            <p>
              <label class="col-sm-2 control-label">Type:</label>
              <select name="type"> <option value=""> Pick Ride Type: </option>
                  <option value="offer" <?php if($type == 'offer') { ?> selected <?php } ?> >offers</option>
                  <option value="request" <?php if($type == 'request') { ?> selected <?php } ?> >request</option>
              </select>
            </p>

            <br></br>
            <p>
              <input class="btn btn-primary" style="width:150px;" type="submit" name="formSelect" value="Select">
            </p>

            <br></br>

            <p>
              Fill Out Ride Details:
            </p>

            <p>
              <label class="col-sm-2 control-label">Date:</label>
              <input type="date" name="day"> 
            </p>

            <p>
              <label class="col-sm-2 control-label">Start Point:</label>
              <select name= "start"> <option value=""> Pick Up </option>
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
            </p>

            <p>
              <label class="col-sm-2 control-label">End Point:</label>
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
            </p>

            <p>
              <label class="col-sm-2 control-label">  Number of Seats Available:</label>
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
            </p>

            <br></br>
            <p>
              <input class="btn btn-primary" style="width:150px;" type="submit" name="formSubmit" value="Search For My Ride!" >
            </p>
          </div>
        </form>

      </div>

      

      <?php

        $getType3="";

        if(isset($_GET['formSelect'])) {
          global $getType3;
          $getType3 = $_GET['type'];
        }

        function setType2() {
          $getType3 = $_GET['type'];
          global $getType;
          if ($getType3 == "offer") {
            $getType = "creates_offer";
          } else if ($getType3 == "request") {
            $getType = "creates_request";
          } else {
            echo "I'm in the else case";
            $getType = "creates_request";
          }     
        }

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


            // Presentation :
            // echo "<b>SQL:   </b>".$query."<br><br>";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            echo "<table border=\"1\" >
            <col width=\"10%\">
            <col width=\"30%\">
            <col width=\"30%\">
            <col width=\"10%\">
            <col width=\"5%\">
            <col width=\"15%\">
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
    <br> </br>
    <a href="http://127.0.0.1/main.php">Back</a>
    </div>

     
      
    
  </body>
</html>
