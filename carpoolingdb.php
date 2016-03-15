<?php
$db = include 'postgresconnect.php';
?>

<?php
        $query = "INSERT INTO users VALUES('Michele Sim', 'ms12345', 'michsim@gmail.com', '50.00');";
        $result = pg_query($query); 
        handleError($result);
    
        $query = "INSERT INTO users VALUES('Muhammad Ali', 'ma12345', 'mhdali@gmail.com', '5.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Anand Kumar', 'ak12345', 'akumar@hotmail.com', '75.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Gurmit Singh', 'gs12345', 'pck@hotmail.com', '88.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Francis', 'f12345', 'francist@hotmail.com', '35.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Veronica', 'v12345', 'verrrr@hotmail.com', '11.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Kenneth', 'k12345', 'kenorkennot@hotmail.com', '31.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Lin Jun Jie', 'ljj12345', 'jjlin@yahoo.com', '250.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Ronald', 'r12345', 'roll1991@yahoo.com', '22.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Joey Tan', 'jt12345', 'mojojojo@gmail.com', '22.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Amos Zee', 'az12345', 'freespeech@gmail.com', '19.00');";
        $result = pg_query($query); 
        handleError($result);
    
        $query = "INSERT INTO users VALUES('Faizal Rahul', 'fr12345', 'goodboy1992@hotmail.com', '27.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Anthony Kumar', 'ak12345', 'antk@gmail.com', '10.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Ash Crater', 'ac12345', 'pkmnmaster@yahoo.com', '66.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Chris Tang', 'ct12345', 'csoup@hotmail.com', '35.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Chen Qi Ting', 'cqt12345', 'qeetee@gmail.com', '47.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Ji Sung Park', 'jsp12345', 'jspark@gmail.com', '99.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Hibari Kyoya', 'hk12345', 'kamikorosu@hotmail.com', '14.00');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO users VALUES('Albert Halim', 'ah12345', 'ahbattle@gmail.com', '67.00');";
        $result = pg_query($query); 
        handleError($result);
    
        echo "users table successfully populated.<br>";       
        
        // This line changes date format to dd/mm/yyyy
        $query = "SET datestyle = \"ISO, DMY\"";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO creates_request VALUES('1', 'Ang Mo Kio Avenue 30', 'Yew Tee Lane 99', '2', '01/08/2016', '1300', 'Ronald');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO creates_request VALUES('2', 'Pasir Ris Drive 11', 'NUS School of Computing', '1', '05/08/2016', '0800', 'Kenneth');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO creates_request VALUES('3', 'Jurong North Street 77', 'Changi Airport T5', '3', '25/12/2016', '0600', 'Michele Sim');";
        $result = pg_query($query); 
        handleError($result);
    
        echo "creates_request table successfully populated.<br>"; 
        
        $query = "INSERT INTO owns_car VALUES('SBB1578X', '3', 'Muhammad Ali');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO owns_car VALUES('SJT5824B', '3', 'Joey Tan');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO owns_car VALUES('SHE7742C', '4', 'Lin Jun Jie');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO owns_car VALUES('SZZ8001F', '5', 'Gurmit Singh');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO owns_car VALUES('SGG5521H', '4', 'Chris Tang');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO owns_car VALUES('SFD1299D', '4', 'Albert Halim');";
        $result = pg_query($query); 
        handleError($result);
    
        echo "owns_car table successfully populated.<br>"; 
         
        // offerid, from, to, trip cost, num seats remaining, usedCar
         
        $query = "INSERT INTO creates_offer VALUES('1', 'Paya Lebar Block 199', 'SMU Block A', '5', '1', 'SBB1578X');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO creates_offer VALUES('2', 'Townhill Secondary School', 'East Coast Park', '4.50', '2', 'SJT5824B');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO creates_offer VALUES('3', 'Woodlands Lane 7', 'Singapore Zoo', '6.50', '2', 'SGG5521H');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO creates_offer VALUES('4', 'Sengkang West Block 190', 'NUS School of Computing', '4.50', '0', 'SFD1299D');";
        $result = pg_query($query); 
        handleError($result);
    
        echo "creates_offer table successfully populated.<br>"; 
        
        // isusernotified, username, offerid
        
        $query = "INSERT INTO booking VALUES('false', 'Veronica', '1');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('false', 'Francis', '1');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('false', 'Anand Kumar', '2');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('false', 'Amos Zee', '3');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('false', 'Anthony Kumar', '3');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('true', 'Faizal Rahul', '4');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('true', 'Ash Crater', '4');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('true', 'Hibari Kyoya', '4');";
        $result = pg_query($query); 
        handleError($result);
        
        $query = "INSERT INTO booking VALUES('true', 'Chen Qi Ting', '4');";
        $result = pg_query($query); 
        handleError($result);
    
        echo "booking table successfully populated.<br>";

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