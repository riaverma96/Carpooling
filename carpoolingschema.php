<?php
$db = include 'postgresconnect.php';
?>

<?php
        $query = "CREATE TABLE users(
          name VARCHAR(64) PRIMARY KEY,
          password VARCHAR(64) NOT NULL,
          email VARCHAR(128) UNIQUE,
          money numeric NOT NULL
        );";
        $result = pg_query($query); 
        handleError($result);
    
        echo "users table successfully created.<br>";       
        
        $query = "CREATE TABLE creates_request(
          rid numeric PRIMARY KEY,
          fromWhere VARCHAR(128) NOT NULL,
          toWhere VARCHAR(128) NOT NULL,
          numSeatsWanted numeric,
          rDate DATE NOT NULL,
          rTime VARCHAR(4) NOT NULL, 
          requestor VARCHAR(64),
          FOREIGN KEY (requestor) REFERENCES users(name)
        );";
        $result = pg_query($query); 
        handleError($result);
    
        echo "creates_request table successfully created.<br>"; 
        
        $query = "CREATE TABLE owns_car(
          license VARCHAR(16) PRIMARY KEY,
          numFreeSeats numeric,
          cOwner VARCHAR(64) REFERENCES users(name)
        );";
        $result = pg_query($query); 
        handleError($result);
    
        echo "owns_car table successfully created.<br>"; 
      
        $query = "CREATE TABLE creates_offer(
          offerid numeric PRIMARY KEY,
          fromWhere VARCHAR(128) NOT NULL,
          toWhere VARCHAR(128) NOT NULL,
          tripCost numeric NOT NULL,
          numSeatsRemaining numeric NOT NULL,
          usedCar VARCHAR(16) REFERENCES owns_car(license)
        );";
        $result = pg_query($query); 
        handleError($result);
    
        echo "creates_offer table successfully created.<br>"; 
        
        $query = "CREATE TABLE booking(
          isUserNotified VARCHAR(8) NOT NULL,
          username VARCHAR(64) REFERENCES users(name),
          offerid numeric REFERENCES creates_offer(offerid),
          PRIMARY KEY (username, offerid)
        );";
        $result = pg_query($query); 
        handleError($result);
    
        echo "booking table successfully created.<br>"; 

        pg_free_result($result);
        pg_close($dbconn); 
        
        function handleError($result)
        {
            if (!$result) {
                $errormessage = pg_last_error(); 
                echo "Error with query: " . $errormessage; 
                exit();
            }
            return;
        }
?> 

<p> All tables inserted.</p>