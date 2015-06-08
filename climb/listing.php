<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
require_once("login.php");
//require_once("tableCreate.php");


class Listing{
	//variables
	public $userId;
	public $title;
	public $description;
	public $type; // 1 = part  0 = service

	//functions
	function populateListing($userId, $title, $description, $type){
		$this->userId = $userId;
		$this->title = $title;
		$this->description = $description;
		$this->type = $type;
	}

	function addToDB($host, $user, $passord, $database){
		//establish connection
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
		    $mysqli->connect_error;
		}
        
		
		//Prepare statement
		if (!($stmt = $mysqli->prepare("INSERT INTO listings 
								      (userId, title, description, lORe) 
								      VALUES 
								      (?, ?, ?, ?)"))) {
		  echo "Prepare failed: (".$mysqli->errno.") ".$mysqli->error;
		}

		//Bind parameters
		if(!$stmt->bind_param("issi", 
			                  $this->userId, 
			                  $this->title,
			                  $this->description,
			                  $this->type)){
			echo "Failed to bind: (" . $stmt->errno. ") " . $stmt->error;
		}

		//execute
		if (!$stmt->execute()){
			echo "Execution failed: (" . $stmt->errno . ")" . $stmt->error;
		}
	
		$stmt->close();
		$mysqli->close();
	}
    
}

?>