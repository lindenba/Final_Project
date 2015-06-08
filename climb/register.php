<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <?php
            if ($_SESSION['error']) {
                $_SESSION['error'] = false;
                echo "<div id='error'>" . $_SESSION['message'] . "</div>";
            }
            if ($_SESSION['success']) {
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
                <form action="insertUser.php" method="post">
                    <legend><b>Please register</b></legend><br><br>
                    
                    <label>First name:</label><input type='text' name='fname' /><br><br>
                    <label>Last name:</label><input type='text' name='lname' /><br><br>
                    <label>Username:</label><input type='text' id="username" name='uname' /><br><br>
                    <label>Password:</label><input type='password' id="password" name='passwd' /><br><br>
                    <label>Verify Password:</label><input type='password' id="password2" name='passwd' /><br><br>
                    <input type='submit' value='Register' onClick="validateUsername()" /></br><br>
                <a href="index.php"><div class="button">Login</div></a>

                </form>
            </div>
            <br><br>
        </div>
    </fieldset>
    <script src="validate.js"></script>
    </body>
    </html