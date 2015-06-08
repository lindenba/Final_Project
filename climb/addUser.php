<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
require_once("login.php");

class User{
	//variables
	public $userName;
	public $firstName;
	public $lastName;
	public $password;


	//functions
	function populateUser($userName, $firstName, $lastName, $password){
		$this->userName = $userName;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->password = $password;
	}

	function addToDB($host, $user, $passord, $database){
		//establish connection
		$mysqli = new mysqli($host, $user, $passord, $database);
		if ($mysqli->connect_errno) {
		    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
		    $mysqli->connect_error;
		}

		
		//Prepare statement
		if (!($stmt = $mysqli->prepare("INSERT INTO users 
								      (fname, lname, uname, passwd) 
								      VALUES 
								      (?, ?, ?, ?)"))) {
		  echo "Prepare failed: (".$mysqli->errno.") ".$mysqli->error;
		}

		//Bind parameters
		if(!$stmt->bind_param("ssss", 
			                  $this->firstName, 
			                  $this->lastName,
			                  $this->userName,
			                  $this->password)){
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