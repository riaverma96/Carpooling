<?php
	$todayDate = date('Y-m-d');
	// Delete from booking table first.
	$query = "DELETE FROM booking b WHERE b.offerid IN (
		SELECT o.offerid FROM creates_offer o WHERE o.offerdate < '$todayDate')";
	$result = pg_query($query);		
	handleError($result);
	
	// Then delete from creates_offer table due to foreign key
	$query = "DELETE FROM creates_offer o WHERE o.offerdate < '$todayDate'";
	$result = pg_query($query);		
	handleError($result);
			
	function handleError($result) {
        if (!$result) {
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit();
        }
        return;
    }
?>