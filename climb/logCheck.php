<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();

$userCheck = $_POST['uname'];
$passCheck = $_POST['passwd'];
$validUser = false;

// make connect
$mysqli=new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
    $mysqli->connect_error;
}
// prepare statement
if (!($stmt=$mysqli->prepare("SELECT uname, id FROM users WHERE uname=? AND passwd=?"))) {
  echo "Prepare failed: (".$mysqli->errno.") ".$mysqli->error;
}
// bind params
if (!($stmt->bind_param("ss", $userCheck, $passCheck))) {
    echo "Binding parameters failed: (".$stmt->errno.") ".$stmt->error;
}
// execute
if (!($stmt->execute())) {
  echo "Execute failed: (".$stmt->errno.") ".$stmt->error;
}
// bind result
$stmt->bind_result($uname, $id);
// fetch value
while ($stmt->fetch()) {
    if ($uname == $userCheck) {
        //echo "Welcome, ".$userCheck.". Thank you for logging in.";
        $validUser = true;
        $_SESSION['uname'] = $uname;
        $_SESSION['loggedin'] = true;
        $_SESSION['userId'] = $id;
/*        echo "<br>";
        echo "<a href=\"../add_part/addListing.php\"> list a part or service </a>";
        echo "<br><br><a href=\"../search_part/searchPage.php\">Search for a part/service</a>";
        echo "<p><a href='../display_all/display.php'>Browse parts</a></p>";*/
        header("refresh:0;url=main.php");
    }
}
// close statement
$stmt->close();


if (!$validUser) {
    //echo "Invalid login credentials. Please try again.";
    // echo $_SERVER["HTTP_HOST"];
    // echo $_SERVER['PHP_SELF'];
    $_SESSION['error'] = true;
    $_SESSION['message'] = "Invalid login credentials. Please try again.";
    header("refresh:0;url=index.php");
}
?>