<?php
ini_set('display_errors', 'On');
session_start();

// make connect
$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lindenba-db", "ntVB3yI2RNUm7xHg", "lindenba-db");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") ".
    $mysqli->connect_error;
}

$search = "%{$_POST['search']}%";
$type = intval($_POST['type']);

//printf("%s %i\n", $search, $type);

if (strlen($search) == 2) {
    $_SESSION['error'] = true;
    $_SESSION['message'] = "Please enter search terms.";
    header("refresh:0;url=searchPage.php");
} else {
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
            <a href="display.php"><div class="button">On-sight</div></a>
            <a href="addListing.php"><div class="button">List a location or equipment</div></a>
            <a href="main.php"><div class="button">View your posts</div></a><br><br>
            
            <p><b>Search Results:</b></p>

<?php
    if (!($stmt = $mysqli->prepare("SELECT title, description  FROM listings WHERE lORe=? AND title LIKE ?"))) {
        echo "Prepare Failed: (".$mysqli->errno.") ".$mysqli->error;
    }
    
    if(!$stmt->bind_param("is", $type, $search)) {
        echo "Bind Failed: (".$stmt->errno.") ".$stmt->error;
    }
    
    if(!$stmt->execute()) {
        echo "Execution Failed: (".$stmt->errno.") ".$stmt->error;
    }
    
    if(!$stmt->bind_result($searchTitle, $searchDescription)) {
        echo "Bind Results Failed: (".$stmt->errno.") ".$stmt->error;
    }
    $rows = 0;
    
    while ($stmt->fetch()) {
        $rows++;
        
        if ($rows == 1) {
            echo "<table>";
            echo "<thead>";
            echo "<th>Title<th>Description";
            echo "</thead>";
            echo "<tbody>";
        }

        echo "<tr>";
        echo "<td>".$searchTitle;
        echo "<td>".$searchDescription;
        /*
        printf("%s %s \n", $searchTitle, $searchDescription);
        printf("<br><br>");
        */
    }
    
    if ($rows > 0) {
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No results found<br>";
    }
    
    echo "<br><div class='button'><a href='searchPage.php'>Search again?</div></a><br><br>";
}
?>
        
        </div>
    </fieldset>
    </body>
</html>