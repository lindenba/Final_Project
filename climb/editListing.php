<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();
require_once("login.php");

class Edit{
    function removeItem($host, $user, $passord, $database, $id){
        //establish connection
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
		    $mysqli->connect_error;
		}
		
		//Prepare statement
		if (!($stmt = $mysqli->prepare("DELETE FROM listings 
								       WHERE id = ?"))) {
		  echo "Prepare failed: (".$mysqli->errno.") ".$mysqli->error;
		}
		
		//Bind parameters
		if(!$stmt->bind_param("i", $id)){
			echo "Failed to bind: (" . $stmt->errno. ") " . $stmt->error;
		}

		//execute
		if (!$stmt->execute()){
			echo "Execution failed: (" . $stmt->errno . ")" . $stmt->error;
		}
	
		$stmt->close();
		$mysqli->close();
    }
    
    
	function updateListing($host, $user, $passord, $database, $listing_id, $change_array){
	    //establish connection
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
		    $mysqli->connect_error;
		}
		
		$where = ' WHERE id = '. $listing_id;
		
		
		$query = "UPDATE listings SET ";
		
		foreach($change_array as $field => $value){
			$updates[] = "" . $field . " = '" . $value . "'";
		}
		
		$query .= implode(', ', $updates);
		
		$query .= $where;
		
		echo $query;
		
		//query statement
		$update = $mysqli->query($query);
		
		if ($update){
			$_SESSION['success'] = true;
			$_SESSION['message'] = "Update successful";
			
			//return to main
			header('Location: main.php');
		} else {
			$_SESSION['error'] = true;
			$_SESSION['message'] = "Update failed";
			
			//return to main
			header('Location: main.php');
		}
	
		$mysqli->close();
	}
    
}

?>