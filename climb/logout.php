<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
//START A SESSION
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Log out</title>
	<link href="stylesheet.css" type="text/css" rel="stylesheet" />	
</head>
<body>  
  <div id="banner">
            <h1 id="title">Climbing Beta</h1>
        </div>
	<div class="wrapper">
      <a href="index.php"><input type='submit' value='Login' /></a></div>      		
		<div id="content">
		  <?php
		  //check if the user is signed in
      if(isset($_SESSION['uname']))		//user has signed in
      {
        $_SESSION = array(); //clears out all data stored in SESSION
		    session_destroy();	//destroy the session - cookie that identifies it is destroyed	
				echo "<p>Successfully logged out, thanks for visiting.</p>";
      }
			else
			{
			  echo "<p>You are not logged in.</p>"; 
			}
      ?>
		  
		</div>
	</div><!--wrapper-->
</body>
</html>