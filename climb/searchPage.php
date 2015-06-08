<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();
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
            <br>Hello, <?php echo $_SESSION['uname']; ?><a href="logout.php"><input type='submit' value='Logout' /><a href="main.php"><input type='submit' value='Main' /></a><br><br>
            <a href="display.php"><div class="button">On-sight</div></a>
            <a href="addListing.php"><div class="button">List a location or equipment</div></a>
            <a href="main.php"><div class="button">View your posts</div></a><br><br>
            <br>
            <div id="form_wrap">
                <form action="searchListing.php" method="post">
                    <legend><b>Search Climbing Database</b></legend><br><br>
                    <div class="left">
                        <label>Type:</label>
                        <select name='type'>
                            <option value='1'>Location</option>
                            <option value='0'>Equipment</option>
                        </select><br><br>
                        <label>Search: </label><input type='text' name='search' /><br><br>
                    </div>
                    <input type='submit' value='Search'/>
                </form>
            </div>
            <br><br>
        </div>
    </fieldset>
    </body>
</html>