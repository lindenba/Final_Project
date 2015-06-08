<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
session_start();

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
            <br>
            <div id="form_wrap">
                <form action="logCheck.php" method="post">
                <legend><b>Please login</b></legend><br><br>
                <label>Username:</label><input type='text' name='uname' /><br><br>
                <label>Password:</label><input type='password' name='passwd' /><br><br>
                <input type='submit' value='Crush' /><br><br>
                <legend><b>Not Registered?</b></legend><br>
                <a href="register.php"><div class="button">Register</div></a>
                </form>
            </div>
            </fieldset>
            <br><br>
        </div>
        <script src="validateLog.js"></script>
    </body>
</html>
