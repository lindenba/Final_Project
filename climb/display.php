<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();

/*if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
    echo "<p>Hello, ".$_SESSION['uname'].".</p>";
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div id="banner">
            <h1 id="title">Climbing Beta</h1>
        </div>
        <fieldset>
        <div id="page_wrap">
            <br>Hello, <?php echo $_SESSION['uname']; ?><a href="logout.php"><input type='submit' value='Logout' /><a href="main.php"><input type='submit' value='Main' /></a><br><br>
            <a href="searchPage.php"><div class="button">Problem</div></a>
            <a href="addListing.php"><div class="button">List a location or equipment</div></a>
            <a href="main.php"><div class="button">View your posts</div></a><br><br>
            
            <p><b>Climbing Location/Equipment:</b></p>
            <table id='parts'>
            <thead>
                <th>User<th>Timestamp<th>Title<th>Description<th>Location/Equipment
            </thead>
            <tbody>

<?php
// open connection to db
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (".$mysqli->connect_errno.
    ") ".$mysqli->connect_error;
}
// query
$prepare = "SELECT u.uname, l.title, l.description, l.ts, l.lORe from users u
INNER JOIN listings l ON l.userId=u.id WHERE 1";
//prepare statement
if (!($stmt=$mysqli->prepare($prepare))) {
  echo "Prepare failed: (".$mysqli->errno.") ".$mysqli->error;
}
//execute
if (!($stmt->execute())) {
  echo "Execute failed: (".$stmt->errno.") ".$stmt->error;
}
//bind result
$stmt->bind_result($user, $pTitle, $pDescription, $pTimestamp, $pService);
//fetch value
while ($stmt->fetch()) {
    echo "<tr><td>".$user;
    echo "<td>".$pTimestamp;
    echo "<td>".$pTitle;
    echo "<td>".$pDescription."<td>";
    if ($pService) {
        echo "Location";
    } else {
        echo "Equipment";
    }
}
//close statement
$stmt->close();
//close connection
$mysqli->close();
?>

      </tbody>
    </table><br><br>
</fieldset>
  </body>
</html>