<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();
require_once("login.php");

if (!$_SESSION['loggedin']) {
    //redirect to login
    header("Location: "."http://".$_SERVER['HTTP_HOST']."index.php");
    die();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <?php 
            if (isset($_SESSION['error']) && $_SESSION['error']) {
                $_SESSION['error'] = false;
                echo "<div id='error'>" . $_SESSION['message'] . "</div>";
            }
            if (isset($_SESSION['success']) && $_SESSION['success']) {
                $_SESSION['success'] = false;
                echo "<div id='success'>" . $_SESSION['message'] . "</div>";
            }    
        ?>
        <div id="banner">
            <h1 id="title">Climbing Beta</h1>
        </div>
        <fieldset>
        <div id="page_wrap">
            <br>Hello, <?php echo $_SESSION['uname']; ?><a href="logout.php"><input type='submit' value='Logout' /></a><br><br>
            <p>Post anything related to climbing: from climbing route beta to gear to be sold.</p>
            <p>On-sight: to look at all posts</p>
            <p>Problem: to search specific items or locations</p>
            <a href="addListing.php"><div class="button">List climbing info</div></a>
            <a href="display.php"><div class="button">On-sight</div></a>
            <a href="searchPage.php"><div class="button">Problem</div></a><br><br>
            

<?php
// make connect
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
    $mysqli->connect_error;
}

/*Print users parts*/

//get all listings from user
// prepare statement
if (!($stmt=$mysqli->prepare("SELECT l.id, l.title, l.description, l.lORe 
                              FROM listings l 
                              INNER JOIN users u ON l.userId=u.id
                              WHERE u.uname=?"))) {
  echo "Prepare failed: (".$mysqli->errno.") ".$mysqli->error;
}

// bind params
if (!($stmt->bind_param("s", $_SESSION['uname']))) {
    echo "Binding parameters failed: (".$stmt->errno.") ".$stmt->error;
}
// execute
if (!($stmt->execute())) {
  echo "Execute failed: (".$stmt->errno.") ".$stmt->error;
}
// bind result
$stmt->bind_result($pID, $pTitle, $pDescription, $pService);

$rows = 0;

while ($stmt->fetch()) {
    $rows++;
    
    if ($rows == 1) {
        echo "<p><b>Your posts:</b></p>";
        echo "<table id='user_parts'>";
        echo "<thead>";
        echo "<th>Title<th>Description<th>Location/Equipment<th>Remove<th>Update";
        echo "</thead>";
        echo "<tbody>";
    }
    
    //fetch value
    $validUser = true;
    echo "<tr>";
    echo "<td>".$pTitle;
    echo "<td>".$pDescription;
    if ($pService) {
        echo "<td>Location";
    } else {
        echo "<td>Equipment";
    }
    echo "<td> <form action='delete.php' method='POST'>";
    echo "<input type='hidden' name='ID' value=". $pID  .">";
    echo "<input type='submit' value='Delete'>";
    echo "</form>";
    
    
    echo "<td> <form action='edit.php' method='POST'>";
    echo "<input type='hidden' name='ttl' value=". $pTitle  .">";
    echo "<input type='hidden' name='desc' value=". $pDescription  .">";
    echo "<input type='hidden' name='ps' value=". $pService  .">";
    echo "<input type='hidden' name='ID' value=". $pID  .">";
    echo "<input type='submit' value='Update'>";
    echo "</form>";
}

if ($rows > 0) {
    echo "</tbody>";
    echo "</table>";
}

//close statement
$stmt->close();

// close connection
$mysqli->close();

?>

        <br><br></div>
        </fieldset>
    </body>
</html>